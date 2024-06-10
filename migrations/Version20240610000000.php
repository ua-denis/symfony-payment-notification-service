<?php

namespace migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240610000000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create payment and payment_notification tables';
    }

    public function up(Schema $schema): void
    {
        // Payment table
        $this->addSql(
            'CREATE TABLE payment (
            id INT AUTO_INCREMENT NOT NULL,
            transaction_id VARCHAR(255) NOT NULL,
            user_order_id VARCHAR(255) NOT NULL,
            amount NUMERIC(10, 2) NOT NULL,
            bonus_amount NUMERIC(10, 2) DEFAULT NULL,
            currency VARCHAR(3) NOT NULL,
            status VARCHAR(255) NOT NULL,
            order_created_at DATETIME NOT NULL,
            order_complete_at DATETIME NOT NULL,
            email VARCHAR(255) DEFAULT NULL,
            payment_method VARCHAR(255) NOT NULL,
            payment_method_group VARCHAR(255) NOT NULL,
            is_cash TINYINT(1) NOT NULL,
            send_push TINYINT(1) NOT NULL,
            processing_time INT NOT NULL,
            PRIMARY KEY(id)
        )'
        );

        // PaymentNotification table
        $this->addSql(
            'CREATE TABLE payment_notification (
            id INT AUTO_INCREMENT NOT NULL,
            transaction_id VARCHAR(255) NOT NULL,
            status VARCHAR(255) NOT NULL,
            notified_at DATETIME NOT NULL,
            PRIMARY KEY(id)
        )'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE payment_notification');
    }
}