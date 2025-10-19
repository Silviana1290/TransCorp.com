<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        DB::unprepared("
            DROP TRIGGER IF EXISTS trg_after_insert_receipt_detail;
            DROP TRIGGER IF EXISTS trg_before_insert_shipment_detail;
            DROP TRIGGER IF EXISTS trg_after_insert_shipment_detail;

            CREATE TRIGGER trg_after_insert_receipt_detail
            AFTER INSERT ON receipt_details
            FOR EACH ROW
            BEGIN
                DECLARE wid INT;
                SET wid = (SELECT warehouse_id FROM receipts WHERE id = NEW.receipt_id);
                IF (SELECT COUNT(*) FROM stocks WHERE item_id = NEW.item_id AND warehouse_id = wid) = 0 THEN
                    INSERT INTO stocks (item_id, warehouse_id, quantity, created_at, updated_at)
                    VALUES (NEW.item_id, wid, NEW.qty, NOW(), NOW());
                ELSE
                    UPDATE stocks SET quantity = quantity + NEW.qty, updated_at = NOW()
                    WHERE item_id = NEW.item_id AND warehouse_id = wid;
                END IF;
                INSERT INTO inventory_histories (item_id, warehouse_id, change_qty, reason, reference_id, operator_id, note, created_at, updated_at)
                VALUES (NEW.item_id, wid, NEW.qty, 'receipt', NEW.receipt_id, (SELECT operator_id FROM receipts WHERE id = NEW.receipt_id), CONCAT('receipt_detail:',NEW.id), NOW(), NOW());
            END;
        ");

        DB::unprepared("
            CREATE TRIGGER trg_before_insert_shipment_detail
            BEFORE INSERT ON shipment_details
            FOR EACH ROW
            BEGIN
                DECLARE wid INT;
                DECLARE curr_qty INT;
                SET wid = (SELECT warehouse_id FROM shipments WHERE id = NEW.shipment_id);
                SELECT quantity INTO curr_qty FROM stocks WHERE item_id = NEW.item_id AND warehouse_id = wid LIMIT 1;
                IF curr_qty IS NULL OR curr_qty < NEW.qty THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Insufficient stock for shipment';
                END IF;
            END;
        ");

        DB::unprepared("
            CREATE TRIGGER trg_after_insert_shipment_detail
            AFTER INSERT ON shipment_details
            FOR EACH ROW
            BEGIN
                DECLARE wid INT;
                SET wid = (SELECT warehouse_id FROM shipments WHERE id = NEW.shipment_id);
                UPDATE stocks SET quantity = quantity - NEW.qty, updated_at = NOW()
                WHERE item_id = NEW.item_id AND warehouse_id = wid;
                INSERT INTO inventory_histories (item_id, warehouse_id, change_qty, reason, reference_id, operator_id, note, created_at, updated_at)
                VALUES (NEW.item_id, wid, -NEW.qty, 'shipment', NEW.shipment_id, (SELECT operator_id FROM shipments WHERE id = NEW.shipment_id), CONCAT('shipment_detail:',NEW.id), NOW(), NOW());
            END;
        ");
    }

    public function down(): void {
        DB::unprepared('
            DROP TRIGGER IF EXISTS trg_after_insert_receipt_detail;
            DROP TRIGGER IF EXISTS trg_before_insert_shipment_detail;
            DROP TRIGGER IF EXISTS trg_after_insert_shipment_detail;
        ');
    }
};