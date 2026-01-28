<?php
/**
 * Add More Products Script
 * This script adds additional products to the database
 */

include('server/connection.php');

$success_count = 0;
$error_count = 0;
$errors = [];

// Array of new products to add
$new_products = [
    // Sofas
    ['Modern Blue Sofa', 'sofa', 'Contemporary blue sofa with plush cushions and elegant design. Perfect for modern living rooms, offering both style and comfort.', 'bluesofa1.jpg', 'bluesofa2.jpg', 'bluesofa3.jpg', '', 12500.00, 0, 'blue'],
    ['Classic Comfort Sofa', 'sofa', 'Traditional sofa with timeless design. Features high-quality upholstery and comfortable seating for the whole family.', 'sofa1.jpg', 'sofa3.jpg', 'sofa4.jpg', '', 15000.00, 0, 'brown'],
    ['Luxury Velvet Sofa', 'sofa', 'Premium velvet sofa with elegant curves and luxurious feel. A statement piece that adds sophistication to any space.', 'sofa3.jpg', 'sofa4.jpg', 'sofa1.jpg', '', 18000.00, 0, 'gray'],
    
    // Chairs
    ['Ergonomic Office Chair', 'chair', 'Comfortable office chair with lumbar support and adjustable height. Perfect for long work sessions.', 'chair1.jpg', 'chair2.jpg', 'chair3.jpg', '', 4500.00, 0, 'black'],
    ['Modern Dining Chair', 'chair', 'Sleek dining chair with contemporary design. Comfortable and stylish, perfect for modern dining rooms.', 'chair2.jpg', 'chair3.jpg', 'chair4.jpg', '', 3200.00, 0, 'white'],
    ['Classic Wooden Chair', 'chair', 'Traditional wooden chair with elegant craftsmanship. Durable and timeless design.', 'chair3.jpg', 'chair4.jpg', 'chair1.jpg', '', 2800.00, 0, 'brown'],
    ['White Modern Chair', 'chair', 'Minimalist white chair with clean lines. Perfect for modern and Scandinavian interiors.', 'white chair1.jpeg', 'white chair2.jpeg', 'white chair3.jpeg', 'white chair4.jpeg', 3500.00, 0, 'white'],
    ['Designer Accent Chair', 'chair', 'Unique accent chair that adds character to any room. Bold design with premium materials.', 'chair4.jpg', 'chair1.jpg', 'chair2.jpg', '', 5500.00, 0, 'gray'],
    
    // Tables
    ['Modern Dining Table', 'table', 'Elegant dining table with clean lines. Seats 6-8 people comfortably. Perfect for family gatherings.', 'table1.jpg', 'table2.jpg', 'table3.jpg', '', 12000.00, 0, 'brown'],
    ['Round Coffee Table', 'table', 'Stylish round coffee table with glass top. Adds elegance to your living room.', 'table2.jpg', 'table3.jpg', 'table4.jpg', '', 6500.00, 0, 'brown'],
    ['Wooden Console Table', 'table', 'Beautiful wooden console table perfect for entryways or behind sofas. Features elegant design and storage.', 'Wooden Console table1.jpeg', 'Wooden Console table2.jpeg', 'Wooden Console table3.jpeg', 'Wooden Console table4.jpeg', 8500.00, 0, 'brown'],
    ['Modern Side Table', 'table', 'Contemporary side table with minimalist design. Perfect for placing next to sofas or beds.', 'table3.jpg', 'table4.jpg', 'table1.jpg', '', 3800.00, 0, 'black'],
    ['Rustic Farm Table', 'table', 'Charming farmhouse-style table with rustic appeal. Great for country or cottage-style homes.', 'table4.jpg', 'table1.jpg', 'table2.jpg', '', 9500.00, 0, 'brown'],
    
    // Coffee Tables
    ['Modern Glass Coffee Table', 'table', 'Sleek glass coffee table with metal frame. Modern and sophisticated design.', 'coffee1.jpg', 'coffee2.jpg', 'coffee3.jpg', '', 5500.00, 0, 'clear'],
    ['Wooden Coffee Table', 'table', 'Classic wooden coffee table with storage. Functional and stylish.', 'coffee2.jpg', 'coffee3.jpg', 'coffee4.jpg', '', 4800.00, 0, 'brown'],
    ['Nested Coffee Tables', 'table', 'Set of nested coffee tables in different sizes. Versatile and space-saving design.', 'coffee3.jpg', 'coffee4.jpg', 'coffee1.jpg', '', 7200.00, 0, 'brown'],
    ['Luxury Marble Coffee Table', 'table', 'Premium marble coffee table with elegant design. A statement piece for luxury interiors.', 'coffee4.jpg', 'coffee1.jpg', 'coffee2.jpg', '', 15000.00, 0, 'white'],
    
    // Carpets
    ['Persian Style Carpet', 'carpet', 'Beautiful Persian-inspired carpet with intricate patterns. Adds warmth and elegance to any room.', 'carpet1.jpg', 'carpet2.jpg', 'carpet3.jpg', '', 8500.00, 0, 'multicolor'],
    ['Modern Geometric Carpet', 'carpet', 'Contemporary carpet with geometric patterns. Perfect for modern interiors.', 'carpet2.jpg', 'carpet3.jpg', 'carpet4.jpg', '', 6200.00, 0, 'gray'],
    ['Plush Shaggy Carpet', 'carpet', 'Luxurious shaggy carpet with soft texture. Extremely comfortable underfoot.', 'carpet3.jpg', 'carpet4.jpg', 'carpet1.jpg', '', 7500.00, 0, 'beige'],
    ['Traditional Oriental Carpet', 'carpet', 'Classic oriental carpet with traditional patterns. Timeless elegance for your home.', 'carpet4.jpg', 'carpet1.jpg', 'carpet2.jpg', '', 9800.00, 0, 'red'],
    
    // Lamps
    ['Modern Floor Lamp', 'lamp', 'Contemporary floor lamp with adjustable height. Perfect for reading corners.', 'lamp1.jpg', 'lamp2.jpg', 'lamp3.jpg', '', 3200.00, 0, 'black'],
    ['Elegant Table Lamp', 'lamp', 'Beautiful table lamp with fabric shade. Creates warm ambient lighting.', 'lamp2.jpg', 'lamp3.jpg', 'lamp4.jpg', '', 2800.00, 0, 'white'],
    ['Industrial Pendant Lamp', 'lamp', 'Stylish industrial-style pendant lamp. Perfect for modern kitchens and dining areas.', 'lamp3.jpg', 'lamp4.jpg', 'lamp5.jpg', '', 4500.00, 0, 'black'],
    ['Crystal Chandelier', 'lamp', 'Luxurious crystal chandelier. Adds elegance and sophistication to any room.', 'lamp4.jpg', 'lamp5.jpg', 'lamp1.jpg', '', 12000.00, 0, 'clear'],
    ['Minimalist Desk Lamp', 'lamp', 'Sleek desk lamp with adjustable arm. Perfect for home offices and study areas.', 'lamp5.jpg', 'lamp1.jpg', 'lamp2.jpg', '', 2500.00, 0, 'white'],
    
    // Wall Decor
    ['Modern Wall Art', 'wall', 'Contemporary wall art piece. Adds color and personality to your walls.', 'wall1.jpg', 'wall2.jpg', 'wall3.jpg', '', 3500.00, 0, 'multicolor'],
    ['Abstract Canvas Print', 'wall', 'Beautiful abstract canvas print. Modern and artistic wall decoration.', 'wall2.jpg', 'wall3.jpg', 'wall4.jpg', '', 4200.00, 0, 'blue'],
    ['Botanical Wall Decor', 'wall', 'Elegant botanical-themed wall decor. Brings nature indoors.', 'wall3.jpg', 'wall4.jpg', 'wall5.jpg', '', 3800.00, 0, 'green'],
    ['Geometric Wall Hanging', 'wall', 'Modern geometric wall hanging. Textured and dimensional design.', 'wall4.jpg', 'wall5.jpg', 'wall6.jpg', '', 3200.00, 0, 'gray'],
    ['Vintage Clock', 'wall', 'Classic vintage-style wall clock. Functional and decorative.', 'clock1.jpg', '', '', '', 2800.00, 0, 'brown'],
    ['Gallery Wall Set', 'wall', 'Curated set of wall art pieces. Ready to create a stunning gallery wall.', 'wall5.jpg', 'wall6.jpg', 'wall1.jpg', '', 5500.00, 0, 'multicolor'],
    
    // Khmer Collection
    ['Khmer Traditional Vase', 'Accessories', 'Authentic Khmer-style ceramic vase. Handcrafted with traditional patterns.', 'khmer1.jpeg', 'khmer2.jpeg', 'khmer3.jpeg', 'khmer4.jpeg', 4500.00, 0, 'brown'],
    ['Khmer Decorative Bowl', 'Accessories', 'Beautiful Khmer decorative bowl. Perfect for centerpieces or display.', 'khmer2.jpeg', 'khmer3.jpeg', 'khmer4.jpeg', 'khmer1.jpeg', 3200.00, 0, 'brown'],
    ['Khmer Artisan Pot', 'Accessories', 'Handcrafted Khmer pot with intricate designs. Unique and authentic.', 'khmer3.jpeg', 'khmer4.jpeg', 'khmer1.jpeg', 'khmer2.jpeg', 3800.00, 0, 'brown'],
];

// Prepare statement
$stmt = $conn->prepare("INSERT INTO products (product_name, product_category, product_description, product_image, product_image2, product_image3, product_image4, product_price, product_special_offer, product_color) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

foreach ($new_products as $product) {
    $stmt->bind_param("sssssssdss", 
        $product[0], // product_name
        $product[1], // product_category
        $product[2], // product_description
        $product[3], // product_image
        $product[4], // product_image2
        $product[5], // product_image3
        $product[6], // product_image4
        $product[7], // product_price
        $product[8], // product_special_offer
        $product[9]  // product_color
    );
    
    if ($stmt->execute()) {
        $success_count++;
    } else {
        $error_count++;
        $errors[] = $stmt->error . " (Product: " . $product[0] . ")";
    }
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products - Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 50px;
            background: #f8f9fa;
        }
        .result-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 0 auto;
        }
        .success {
            color: #28a745;
        }
        .error {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="result-card">
        <h2 class="mb-4">Add Products - Results</h2>
        
        <?php if ($success_count > 0): ?>
            <div class="alert alert-success">
                <h4>✓ Success!</h4>
                <p><strong><?php echo $success_count; ?></strong> products added successfully!</p>
            </div>
        <?php endif; ?>
        
        <?php if ($error_count > 0): ?>
            <div class="alert alert-danger">
                <h4>✗ Errors</h4>
                <p><strong><?php echo $error_count; ?></strong> products failed to add.</p>
                <?php if (!empty($errors)): ?>
                    <ul>
                        <?php foreach (array_unique($errors) as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <div class="mt-4">
            <a href="shop.php" class="btn btn-primary">View Products</a>
            <a href="admin/products.php" class="btn btn-secondary">Admin Panel</a>
        </div>
    </div>
</body>
</html>
