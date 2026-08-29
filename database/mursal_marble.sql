-- ============================================================================
-- Database Script for Mursal Marble & Granite Tiles MVC Project
-- Database Engine: MySQL / MariaDB (InnoDB)
-- Character Set: utf8mb4 / utf8mb4_unicode_ci
-- ============================================================================

SET FOREIGN_KEY_CHECKS = 0;

CREATE DATABASE IF NOT EXISTS `mursal_marble` 
  DEFAULT CHARACTER SET utf8mb4 
  COLLATE utf8mb4_unicode_ci;

USE `mursal_marble`;

-- ----------------------------------------------------------------------------
-- 1. Table: `users`
-- Stores administrative users and client account credentials with hashed passwords.
-- ----------------------------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` VARCHAR(50) NOT NULL DEFAULT 'customer',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX `idx_users_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- 2. Table: `categories`
-- Classifies natural stones (e.g., Marble, Granite, Tiles).
-- ----------------------------------------------------------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_categories_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- 3. Table: `products`
-- Primary inventory table for stone slabs and cut tiles.
-- Foreign Key: `category_id` references `categories(id)` ON DELETE CASCADE
-- ----------------------------------------------------------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `category_id` INT NOT NULL,
  `name` VARCHAR(150) NOT NULL,
  `slug` VARCHAR(150) NOT NULL UNIQUE,
  `description` TEXT NOT NULL,
  `price` DECIMAL(10,2) NOT NULL DEFAULT 0.00, -- 0.00 denotes "Contact for Price"
  `image` VARCHAR(255) DEFAULT NULL,
  `status` VARCHAR(50) NOT NULL DEFAULT 'In Stock',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_products_category` (`category_id`),
  INDEX `idx_products_slug` (`slug`),
  INDEX `idx_products_status` (`status`),
  CONSTRAINT `fk_products_category` 
    FOREIGN KEY (`category_id`) 
    REFERENCES `categories` (`id`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- 4. Table: `gallery`
-- Real-life project installation photos linked to specific products.
-- Foreign Key: `product_id` references `products(id)` ON DELETE CASCADE
-- ----------------------------------------------------------------------------
DROP TABLE IF EXISTS `gallery`;
CREATE TABLE `gallery` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `product_id` INT NOT NULL,
  `title` VARCHAR(150) NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX `idx_gallery_product` (`product_id`),
  CONSTRAINT `fk_gallery_product` 
    FOREIGN KEY (`product_id`) 
    REFERENCES `products` (`id`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- 5. Table: `contacts`
-- Stores client inquiries and quote messages submitted from the public site.
-- ----------------------------------------------------------------------------
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `phone` VARCHAR(30) DEFAULT NULL,
  `subject` VARCHAR(200) NOT NULL,
  `message` TEXT NOT NULL,
  `status` VARCHAR(50) NOT NULL DEFAULT 'unread',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX `idx_contacts_status` (`status`),
  INDEX `idx_contacts_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- DEMO DATA SEEDING
-- ============================================================================

-- Seed Admin User (Password hashed via BCRYPT: admin123)
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Admin Manager', 'admin@mursalmarble.com', '$2y$10$gCzuTTqs0BVCmmt8Spf3muQJsNISZmVDET5aluSq/lle.HLmy5QXe', 'admin'),
(2, 'John Client', 'john@example.com', '$2y$10$5zNMB17odDr4UZ8yHLgtv.PoiXq6vW4JZFxtLhzT69/XefA7R4s/6', 'customer');

-- Seed Categories
INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Marble', 'Exquisite natural Italian and regional marbles known for purity and elegant veining.'),
(2, 'Granite', 'Ultra-durable, scratch-resistant granite stone suitable for high-traffic kitchen countertops.'),
(3, 'Tiles', 'Premium natural stone tiles for wall cladding, bathrooms, and exterior facades.');

-- Seed Sample Products
INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `description`, `price`, `image`, `status`) VALUES
(1, 1, 'Carrara White Marble', 'carrara-white-marble', 'Timeless Italian marble featuring soft silver-gray linear veining. Prized for vanity tops and flooring.', 0.00, 'prod_carrara_white.jpg', 'In Stock'),
(2, 1, 'Calacatta Gold Marble', 'calacatta-gold-marble', 'Rare Italian marble with distinctive bold gold and gray veining on a white background. Perfect for luxury master baths.', 45.00, 'prod_calacatta_gold.jpg', 'In Stock'),
(3, 1, 'Emperador Brown Marble', 'emperador-brown-marble', 'Dark brown Spanish marble with fine white or cream veins. Gives a warm, classical feel to fireplaces, foyers, and countertops.', 38.00, 'prod_emperador_brown.jpg', 'In Stock'),
(4, 1, 'Nero Marquina Black Marble', 'nero-marquina-black-marble', 'Deep jet-black marble with striking, high-contrast white veining. Excellent for modern feature walls, elegant bar tops, and luxury floor designs.', 42.00, 'prod_nero_marquina.jpg', 'In Stock'),
(5, 1, 'Statuario Marble', 'statuario-marble', 'Premier Italian marble featuring a bright white background with bold, dramatic dark gray veins. Highly sought-after for showroom displays, bookmatched panels, and feature walls.', 50.00, 'prod_statuario_white.jpg', 'In Stock'),
(6, 1, 'Botticino Beige Marble', 'botticino-beige-marble', 'Classic Italian marble with a warm beige base and subtle, delicate golden veining. Highly durable, perfect for grand staircases, lobby walls, and luxury villa floors.', 30.00, 'prod_botticino_beige.jpg', 'In Stock'),
(7, 2, 'Black Absolute Granite', 'black-absolute-granite', 'Deep uniform jet-black granite with microscopic crystalline reflections. Ultra low absorption and scratch-resistance.', 32.00, 'prod_black_absolute.jpg', 'In Stock'),
(8, 2, 'Steel Grey Granite', 'steel-grey-granite', 'Mid-to-dark gray granite featuring shades of light gray, charcoal, and black flecks. Very robust, suitable for modern outdoor patios, entryways, and kitchen countertops.', 26.00, 'prod_steel_grey.jpg', 'In Stock'),
(9, 2, 'Kashmir White Granite', 'kashmir-white-granite', 'Elegant white granite with soft gray waves and small dark red garnet flecks. Brightens up kitchens, vanities, and commercial reception areas.', 28.00, 'prod_kashmir_white.jpg', 'In Stock'),
(10, 2, 'Blue Pearl Granite', 'blue-pearl-granite', 'Stunning Norwegian granite with large, iridescent blue and silver pearlescent mineral flakes. Highly reflective, perfect for luxury bathroom vanities, bar tops, and cladding.', 40.00, 'prod_blue_pearl.jpg', 'In Stock'),
(11, 2, 'Red Granite', 'red-granite', 'Rich reddish-brown granite with dark gray and black mineral patterns. Extremely durable and slip-resistant, perfect for commercial exterior facades, plazas, and steps.', 25.00, 'prod_red_granite.jpg', 'In Stock'),
(12, 2, 'Premium Black Galaxy Granite', 'premium-black-galaxy-granite', 'Deep black Indian granite featuring tiny copper or golden-colored metallic flakes resembling stars. Adds high luxury to kitchen countertops and modern fireplace surrounds.', 35.00, 'prod_galaxy_black.jpg', 'In Stock'),
(13, 3, 'Travertine Beige Tiles', 'travertine-beige-tiles', 'Warm cream and beige limestone travertine with linear porous texture. Naturally textured and slip-resistant, perfect for Mediterranean-style pool decks, patios, and rustic bathroom floors.', 22.00, 'prod_travertine.jpg', 'In Stock'),
(14, 3, 'Ceramic Floor Tiles', 'ceramic-floor-tiles', 'Glazed ceramic tiles with a soft matte beige stone texture. Easy to clean and durable, ideal for open-plan living room floors and residential kitchens.', 12.00, 'prod_ceramic_floor.jpg', 'In Stock'),
(15, 3, 'Porcelain Tiles', 'porcelain-tiles', 'Sleek, high-density polished white porcelain tiles with light gray marbling. Extremely durable and stain-resistant, perfect for high-traffic minimal office lobbies.', 15.00, 'prod_porcelain_white.jpg', 'In Stock'),
(16, 3, 'Luxury Bathroom Tiles', 'luxury-bathroom-tiles', 'Designer textured tiles in sophisticated charcoal gray. Enhances walk-in showers, spa walls, and modern powder rooms with a sleek contemporary look.', 18.00, 'prod_luxury_bathroom.jpg', 'In Stock'),
(17, 3, 'Marble Effect Tiles', 'marble-effect-tiles', 'Realistic marble-look porcelain tiles with elegant gray veins. Offers the luxurious look of marble with the low-maintenance benefits of porcelain. Perfect for bathroom floors and walls.', 16.00, 'prod_marble_effect.jpg', 'In Stock'),
(18, 3, 'Outdoor Stone Tiles', 'outdoor-stone-tiles', 'Durable textured gray slate or sandstone tiles. Frost-resistant and heavily textured, perfect for landscaping garden pathways, patios, and exterior wall features.', 20.00, 'prod_outdoor_stone.jpg', 'In Stock');

-- Seed Sample Gallery Records
INSERT INTO `gallery` (`id`, `product_id`, `title`, `image`, `description`) VALUES
(1, 2, 'Luxury Penthouse Floor Installation', 'gal_villa_floor.jpg', 'Polished Calacatta Gold slabs arranged in a bookmatched pattern for living room flooring.'),
(2, 7, 'Modern Kitchen Waterfall Countertop', 'gal_kitchen_island.jpg', 'Black Absolute Granite slab cut with polished bullnose edge.'),
(3, 13, 'Commercial Plaza Lobby Wall', 'gal_hotel_lobby.jpg', 'Navona Travertine tiles installed as a 20ft interior feature wall.');

-- Seed Sample Inquiries
INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `subject`, `message`, `status`) VALUES
(1, 'Sarah Jenkins', 'sarah@designco.com', '+1 555-0198', 'Inquiry for Calacatta Gold 2500 sq ft', 'Looking for a wholesale quotation on 2500 sq ft of Calacatta Gold slabs for a penthouse project.', 'unread'),
(2, 'David Miller', 'dmiller@archstudio.org', '+1 555-0144', 'Sample Request for Black Absolute', 'Please send sample tiles and specification sheets.', 'read');

SET FOREIGN_KEY_CHECKS = 1;
