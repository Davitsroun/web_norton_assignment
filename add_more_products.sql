-- Add More Products to the Database
-- This file adds additional products to expand the product catalog

USE ecom;

-- Sofas
INSERT INTO `products` (`product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
('Modern Blue Sofa', 'sofa', 'Contemporary blue sofa with plush cushions and elegant design. Perfect for modern living rooms, offering both style and comfort.', 'bluesofa1.jpg', 'bluesofa2.jpg', 'bluesofa3.jpg', '', '12500.00', 0, 'blue'),
('Classic Comfort Sofa', 'sofa', 'Traditional sofa with timeless design. Features high-quality upholstery and comfortable seating for the whole family.', 'sofa1.jpg', 'sofa3.jpg', 'sofa4.jpg', '', '15000.00', 0, 'brown'),
('Luxury Velvet Sofa', 'sofa', 'Premium velvet sofa with elegant curves and luxurious feel. A statement piece that adds sophistication to any space.', 'sofa3.jpg', 'sofa4.jpg', 'sofa1.jpg', '', '18000.00', 0, 'gray');

-- Chairs
INSERT INTO `products` (`product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
('Ergonomic Office Chair', 'chair', 'Comfortable office chair with lumbar support and adjustable height. Perfect for long work sessions.', 'chair1.jpg', 'chair2.jpg', 'chair3.jpg', '', '4500.00', 0, 'black'),
('Modern Dining Chair', 'chair', 'Sleek dining chair with contemporary design. Comfortable and stylish, perfect for modern dining rooms.', 'chair2.jpg', 'chair3.jpg', 'chair4.jpg', '', '3200.00', 0, 'white'),
('Classic Wooden Chair', 'chair', 'Traditional wooden chair with elegant craftsmanship. Durable and timeless design.', 'chair3.jpg', 'chair4.jpg', 'chair1.jpg', '', '2800.00', 0, 'brown'),
('White Modern Chair', 'chair', 'Minimalist white chair with clean lines. Perfect for modern and Scandinavian interiors.', 'white chair1.jpeg', 'white chair2.jpeg', 'white chair3.jpeg', 'white chair4.jpeg', '3500.00', 0, 'white'),
('Designer Accent Chair', 'chair', 'Unique accent chair that adds character to any room. Bold design with premium materials.', 'chair4.jpg', 'chair1.jpg', 'chair2.jpg', '', '5500.00', 0, 'gray');

-- Tables
INSERT INTO `products` (`product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
('Modern Dining Table', 'table', 'Elegant dining table with clean lines. Seats 6-8 people comfortably. Perfect for family gatherings.', 'table1.jpg', 'table2.jpg', 'table3.jpg', '', '12000.00', 0, 'brown'),
('Round Coffee Table', 'table', 'Stylish round coffee table with glass top. Adds elegance to your living room.', 'table2.jpg', 'table3.jpg', 'table4.jpg', '', '6500.00', 0, 'brown'),
('Wooden Console Table', 'table', 'Beautiful wooden console table perfect for entryways or behind sofas. Features elegant design and storage.', 'Wooden Console table1.jpeg', 'Wooden Console table2.jpeg', 'Wooden Console table3.jpeg', 'Wooden Console table4.jpeg', '8500.00', 0, 'brown'),
('Modern Side Table', 'table', 'Contemporary side table with minimalist design. Perfect for placing next to sofas or beds.', 'table3.jpg', 'table4.jpg', 'table1.jpg', '', '3800.00', 0, 'black'),
('Rustic Farm Table', 'table', 'Charming farmhouse-style table with rustic appeal. Great for country or cottage-style homes.', 'table4.jpg', 'table1.jpg', 'table2.jpg', '', '9500.00', 0, 'brown');

-- Coffee Tables
INSERT INTO `products` (`product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
('Modern Glass Coffee Table', 'table', 'Sleek glass coffee table with metal frame. Modern and sophisticated design.', 'coffee1.jpg', 'coffee2.jpg', 'coffee3.jpg', '', '5500.00', 0, 'clear'),
('Wooden Coffee Table', 'table', 'Classic wooden coffee table with storage. Functional and stylish.', 'coffee2.jpg', 'coffee3.jpg', 'coffee4.jpg', '', '4800.00', 0, 'brown'),
('Nested Coffee Tables', 'table', 'Set of nested coffee tables in different sizes. Versatile and space-saving design.', 'coffee3.jpg', 'coffee4.jpg', 'coffee1.jpg', '', '7200.00', 0, 'brown'),
('Luxury Marble Coffee Table', 'table', 'Premium marble coffee table with elegant design. A statement piece for luxury interiors.', 'coffee4.jpg', 'coffee1.jpg', 'coffee2.jpg', '', '15000.00', 0, 'white');

-- Carpets
INSERT INTO `products` (`product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
('Persian Style Carpet', 'carpet', 'Beautiful Persian-inspired carpet with intricate patterns. Adds warmth and elegance to any room.', 'carpet1.jpg', 'carpet2.jpg', 'carpet3.jpg', '', '8500.00', 0, 'multicolor'),
('Modern Geometric Carpet', 'carpet', 'Contemporary carpet with geometric patterns. Perfect for modern interiors.', 'carpet2.jpg', 'carpet3.jpg', 'carpet4.jpg', '', '6200.00', 0, 'gray'),
('Plush Shaggy Carpet', 'carpet', 'Luxurious shaggy carpet with soft texture. Extremely comfortable underfoot.', 'carpet3.jpg', 'carpet4.jpg', 'carpet1.jpg', '', '7500.00', 0, 'beige'),
('Traditional Oriental Carpet', 'carpet', 'Classic oriental carpet with traditional patterns. Timeless elegance for your home.', 'carpet4.jpg', 'carpet1.jpg', 'carpet2.jpg', '', '9800.00', 0, 'red');

-- Lamps
INSERT INTO `products` (`product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
('Modern Floor Lamp', 'lamp', 'Contemporary floor lamp with adjustable height. Perfect for reading corners.', 'lamp1.jpg', 'lamp2.jpg', 'lamp3.jpg', '', '3200.00', 0, 'black'),
('Elegant Table Lamp', 'lamp', 'Beautiful table lamp with fabric shade. Creates warm ambient lighting.', 'lamp2.jpg', 'lamp3.jpg', 'lamp4.jpg', '', '2800.00', 0, 'white'),
('Industrial Pendant Lamp', 'lamp', 'Stylish industrial-style pendant lamp. Perfect for modern kitchens and dining areas.', 'lamp3.jpg', 'lamp4.jpg', 'lamp5.jpg', '', '4500.00', 0, 'black'),
('Crystal Chandelier', 'lamp', 'Luxurious crystal chandelier. Adds elegance and sophistication to any room.', 'lamp4.jpg', 'lamp5.jpg', 'lamp1.jpg', '', '12000.00', 0, 'clear'),
('Minimalist Desk Lamp', 'lamp', 'Sleek desk lamp with adjustable arm. Perfect for home offices and study areas.', 'lamp5.jpg', 'lamp1.jpg', 'lamp2.jpg', '', '2500.00', 0, 'white');

-- Wall Decor
INSERT INTO `products` (`product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
('Modern Wall Art', 'wall', 'Contemporary wall art piece. Adds color and personality to your walls.', 'wall1.jpg', 'wall2.jpg', 'wall3.jpg', '', '3500.00', 0, 'multicolor'),
('Abstract Canvas Print', 'wall', 'Beautiful abstract canvas print. Modern and artistic wall decoration.', 'wall2.jpg', 'wall3.jpg', 'wall4.jpg', '', '4200.00', 0, 'blue'),
('Botanical Wall Decor', 'wall', 'Elegant botanical-themed wall decor. Brings nature indoors.', 'wall3.jpg', 'wall4.jpg', 'wall5.jpg', '', '3800.00', 0, 'green'),
('Geometric Wall Hanging', 'wall', 'Modern geometric wall hanging. Textured and dimensional design.', 'wall4.jpg', 'wall5.jpg', 'wall6.jpg', '', '3200.00', 0, 'gray'),
('Vintage Clock', 'wall', 'Classic vintage-style wall clock. Functional and decorative.', 'clock1.jpg', '', '', '', '2800.00', 0, 'brown'),
('Gallery Wall Set', 'wall', 'Curated set of wall art pieces. Ready to create a stunning gallery wall.', 'wall5.jpg', 'wall6.jpg', 'wall1.jpg', '', '5500.00', 0, 'multicolor');

-- Khmer Collection
INSERT INTO `products` (`product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
('Khmer Traditional Vase', 'Accessories', 'Authentic Khmer-style ceramic vase. Handcrafted with traditional patterns.', 'khmer1.jpeg', 'khmer2.jpeg', 'khmer3.jpeg', 'khmer4.jpeg', '4500.00', 0, 'brown'),
('Khmer Decorative Bowl', 'Accessories', 'Beautiful Khmer decorative bowl. Perfect for centerpieces or display.', 'khmer2.jpeg', 'khmer3.jpeg', 'khmer4.jpeg', 'khmer1.jpeg', '3200.00', 0, 'brown'),
('Khmer Artisan Pot', 'Accessories', 'Handcrafted Khmer pot with intricate designs. Unique and authentic.', 'khmer3.jpeg', 'khmer4.jpeg', 'khmer1.jpeg', 'khmer2.jpeg', '3800.00', 0, 'brown');
