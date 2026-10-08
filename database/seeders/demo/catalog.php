<?php

declare(strict_types=1);

/**
 * Content for the public demo shop (see Database\Seeders\DemoShopSeeder).
 *
 * Product and manufacturer names are common Pakistani-market items so the
 * demo reads like a real agro shop. Every vendor, customer, phone number and
 * bank account below is fictional — phone numbers deliberately use the
 * 0300-000xxxx block so none of them belongs to a real person.
 *
 * Product images live in database/seeders/demo/images/products/{image}.webp
 * and were drawn from this same list.
 *
 * Fields: pack = bottle|jerrycan|pouch|bag|box (drawing only), demand = how
 * often it sells (1 slow .. 5 fast), restock = units bought per purchase.
 */
return [
    'shop' => [
        'name' => 'Kissan Agro Traders',
        'receipt_header' => "Kissan Agro Traders\nGhalla Mandi Road, Khanewal\nPh: 065-0000000",
        'receipt_footer' => "Thank you for your business!\nRead the label before use. Returns within 7 days with receipt.",
    ],

    'categories' => ['Insecticide', 'Herbicide', 'Fungicide', 'Rodenticide', 'Micronutrient', 'Plant Growth Regulator'],

    'companies' => ['Syngenta', 'Bayer CropScience', 'FMC', 'BASF', 'Corteva Agriscience', 'UPL', 'Ali Akbar Group', 'Jaffer Agro Services'],

    // Fictional distributors, each supplying the listed companies.
    'vendors' => [
        ['name' => 'Multan Agro Distributors', 'phone' => '0300-0001101', 'address' => 'Vehari Road, Multan', 'opening' => '45000', 'companies' => ['Syngenta']],
        ['name' => 'Punjab Crop Care (Pvt) Ltd', 'phone' => '0300-0001102', 'address' => 'Bosan Road, Multan', 'opening' => '0', 'companies' => ['Bayer CropScience']],
        ['name' => 'Green Valley Agri Services', 'phone' => '0300-0001103', 'address' => 'Kabirwala Road, Khanewal', 'opening' => '18500', 'companies' => ['FMC', 'UPL']],
        ['name' => 'Al-Noor Pesticides Traders', 'phone' => '0300-0001104', 'address' => 'Grain Market, Mian Channu', 'opening' => '0', 'companies' => ['BASF']],
        ['name' => 'Shaheen Agri Partners', 'phone' => '0300-0001105', 'address' => 'Faisalabad Road, Sahiwal', 'opening' => '12000', 'companies' => ['Corteva Agriscience']],
        ['name' => 'Four Seasons Agro Supplies', 'phone' => '0300-0001106', 'address' => 'Industrial Estate, Multan', 'opening' => '0', 'companies' => ['Ali Akbar Group', 'Jaffer Agro Services']],
    ],

    // credit = buys on account and pays later.
    'customers' => [
        ['name' => 'Muhammad Aslam', 'phone' => '0300-0002201', 'address' => 'Chak 45/10-R, Khanewal', 'opening' => '0', 'credit' => true],
        ['name' => 'Haji Rafiq Ahmed', 'phone' => '0300-0002202', 'address' => 'Chak 12/AH, Khanewal', 'opening' => '8500', 'credit' => true],
        ['name' => 'Ghulam Mustafa', 'phone' => '0300-0002203', 'address' => 'Mouza Jahanian', 'opening' => '0', 'credit' => false],
        ['name' => 'Malik Shahid Iqbal', 'phone' => '0300-0002204', 'address' => 'Chak 98/15-L, Mian Channu', 'opening' => '15000', 'credit' => true],
        ['name' => 'Rana Tariq Mehmood', 'phone' => '0300-0002205', 'address' => 'Kabirwala', 'opening' => '0', 'credit' => true],
        ['name' => 'Chaudhry Nadeem Akhtar', 'phone' => '0300-0002206', 'address' => 'Chak 72/10-R, Khanewal', 'opening' => '0', 'credit' => true],
        ['name' => 'Abdul Ghafoor', 'phone' => '0300-0002207', 'address' => 'Basti Malook', 'opening' => '0', 'credit' => false],
        ['name' => 'Sardar Imran Khan Baloch', 'phone' => '0300-0002208', 'address' => 'Tulamba', 'opening' => '22000', 'credit' => true],
        ['name' => 'Mian Javed Iqbal', 'phone' => '0300-0002209', 'address' => 'Chak 36/AH, Khanewal', 'opening' => '0', 'credit' => false],
        ['name' => 'Sajid Hussain', 'phone' => '0300-0002210', 'address' => 'Jahanian Mandi', 'opening' => '0', 'credit' => true],
        ['name' => 'Asghar Ali Joiya', 'phone' => '0300-0002211', 'address' => 'Chak 150/10-R', 'opening' => '0', 'credit' => false],
        ['name' => 'Zafar Iqbal Dogar', 'phone' => '0300-0002212', 'address' => 'Abdul Hakim', 'opening' => '6000', 'credit' => true],
        ['name' => 'Muhammad Ramzan', 'phone' => '0300-0002213', 'address' => 'Chak 11/AH, Khanewal', 'opening' => '0', 'credit' => false],
        ['name' => 'Khalid Mehmood Arain', 'phone' => '0300-0002214', 'address' => 'Mian Channu', 'opening' => '0', 'credit' => true],
        ['name' => 'Naveed Anjum', 'phone' => '0300-0002215', 'address' => 'Kacha Khu', 'opening' => '0', 'credit' => false],
        ['name' => 'Bashir Ahmed Sial', 'phone' => '0300-0002216', 'address' => 'Chak 88/10-R, Khanewal', 'opening' => '0', 'credit' => true],
        ['name' => 'Iftikhar Ahmed', 'phone' => '0300-0002217', 'address' => 'Sardarpur', 'opening' => '0', 'credit' => false],
        ['name' => 'Waqas Ahmad Kamboh', 'phone' => '0300-0002218', 'address' => 'Chak 127/15-L', 'opening' => '0', 'credit' => true],
        ['name' => 'Shaukat Ali Bhatti', 'phone' => '0300-0002219', 'address' => 'Tulamba Road, Mian Channu', 'opening' => '9500', 'credit' => true],
        ['name' => 'Allah Ditta', 'phone' => '0300-0002220', 'address' => 'Basti Kotla, Kabirwala', 'opening' => '0', 'credit' => false],
        ['name' => 'Faisal Aziz Agro Centre', 'phone' => '0300-0002221', 'address' => 'Jahanian', 'opening' => '35000', 'credit' => true],
        ['name' => 'Hafiz Muhammad Saleem', 'phone' => '0300-0002222', 'address' => 'Chak 7/AH, Khanewal', 'opening' => '0', 'credit' => false],
        ['name' => 'Arshad Mahmood Gill', 'phone' => '0300-0002223', 'address' => 'Kabirwala', 'opening' => '0', 'credit' => true],
        ['name' => 'Qadir Bakhsh', 'phone' => '0300-0002224', 'address' => 'Mouza Bharowal', 'opening' => '0', 'credit' => false],
        ['name' => 'Tahir Farms', 'phone' => '0300-0002225', 'address' => 'Chak 60/10-R, Khanewal', 'opening' => '0', 'credit' => true],
    ],

    'banks' => [
        ['name' => 'Meezan Bank — Current A/C', 'account_number' => '0101-0000123456'],
        ['name' => 'HBL — Business Account', 'account_number' => '1234-0000987654'],
        ['name' => 'JazzCash Merchant', 'account_number' => '0300-0001111'],
    ],

    // name, role, email (on a reserved .test domain — never deliverable).
    'staff' => [
        ['name' => 'Ali Raza', 'role' => 'Salesman', 'email' => 'ali.raza@kissan-demo.test'],
        ['name' => 'Usman Tariq', 'role' => 'Salesman', 'email' => 'usman.tariq@kissan-demo.test'],
        ['name' => 'Kashif Mehmood', 'role' => 'Accountant', 'email' => 'kashif.mehmood@kissan-demo.test'],
        ['name' => 'Bilal Ahmed', 'role' => 'Inventory Manager', 'email' => 'bilal.ahmed@kissan-demo.test'],
    ],

    'expense_categories' => ['Shop Rent', 'Electricity Bill', 'Staff Salaries', 'Transport & Freight', 'Tea & Refreshments', 'Repairs & Maintenance', 'Internet & Phone'],

    'banners' => [
        ['title' => 'Wheat Season Offers', 'subtitle' => 'Herbicides for clean, high-yield wheat fields', 'tag' => 'In stock now', 'from' => '#1f4d38', 'to' => '#3d8b5f'],
        ['title' => 'Cotton Crop Protection', 'subtitle' => 'Whitefly, jassid and bollworm control — ask our staff', 'tag' => 'Expert advice', 'from' => '#0d47a1', 'to' => '#1e88e5'],
        ['title' => 'Read the Label, Stay Safe', 'subtitle' => 'Wear gloves and a mask when spraying', 'tag' => 'Safety first', 'from' => '#bf360c', 'to' => '#f4511e'],
    ],

    'products' => [
        // ---- Insecticide ----------------------------------------------------------------
        ['name' => 'Karate 2.5EC', 'brand' => 'Karate', 'formulation' => '2.5 EC', 'active' => 'Lambda-cyhalothrin', 'company' => 'Syngenta', 'category' => 'Insecticide', 'unit' => 'Bottle 250ml', 'net' => '250 ml', 'price' => '950', 'cost' => '720', 'pack' => 'bottle', 'size_class' => 'm', 'color' => '#C62828', 'image' => 'karate-2-5ec', 'demand' => 5, 'restock' => 48],
        ['name' => 'Actara 25WG', 'brand' => 'Actara', 'formulation' => '25 WG', 'active' => 'Thiamethoxam', 'company' => 'Syngenta', 'category' => 'Insecticide', 'unit' => 'Pouch 24g', 'net' => '24 g', 'price' => '650', 'cost' => '480', 'pack' => 'pouch', 'color' => '#1565C0', 'image' => 'actara-25wg', 'demand' => 4, 'restock' => 60],
        ['name' => 'Proclaim 1.9EC', 'brand' => 'Proclaim', 'formulation' => '1.9 EC', 'active' => 'Emamectin benzoate', 'company' => 'Syngenta', 'category' => 'Insecticide', 'unit' => 'Bottle 200ml', 'net' => '200 ml', 'price' => '2500', 'cost' => '1950', 'pack' => 'bottle', 'size_class' => 'm', 'color' => '#6A1B9A', 'image' => 'proclaim-1-9ec', 'demand' => 3, 'restock' => 24],
        ['name' => 'Polo 500SC', 'brand' => 'Polo', 'formulation' => '500 SC', 'active' => 'Diafenthiuron', 'company' => 'Syngenta', 'category' => 'Insecticide', 'unit' => 'Bottle 250ml', 'net' => '250 ml', 'price' => '1650', 'cost' => '1250', 'pack' => 'bottle', 'size_class' => 'm', 'color' => '#00838F', 'image' => 'polo-500sc', 'demand' => 3, 'restock' => 30],
        ['name' => 'Match 050EC', 'brand' => 'Match', 'formulation' => '050 EC', 'active' => 'Lufenuron', 'company' => 'Syngenta', 'category' => 'Insecticide', 'unit' => 'Bottle 100ml', 'net' => '100 ml', 'price' => '1100', 'cost' => '820', 'pack' => 'bottle', 'size_class' => 's', 'color' => '#EF6C00', 'image' => 'match-050ec', 'demand' => 2, 'restock' => 24],
        ['name' => 'Confidor 200SL', 'brand' => 'Confidor', 'formulation' => '200 SL', 'active' => 'Imidacloprid', 'company' => 'Bayer CropScience', 'category' => 'Insecticide', 'unit' => 'Bottle 250ml', 'net' => '250 ml', 'price' => '1200', 'cost' => '900', 'pack' => 'bottle', 'size_class' => 'm', 'color' => '#2E7D32', 'image' => 'confidor-200sl', 'demand' => 5, 'restock' => 48],
        ['name' => 'Movento 240SC', 'brand' => 'Movento', 'formulation' => '240 SC', 'active' => 'Spirotetramat', 'company' => 'Bayer CropScience', 'category' => 'Insecticide', 'unit' => 'Bottle 100ml', 'net' => '100 ml', 'price' => '2900', 'cost' => '2250', 'pack' => 'bottle', 'size_class' => 's', 'color' => '#283593', 'image' => 'movento-240sc', 'demand' => 2, 'restock' => 18],
        ['name' => 'Belt 480SC', 'brand' => 'Belt', 'formulation' => '480 SC', 'active' => 'Flubendiamide', 'company' => 'Bayer CropScience', 'category' => 'Insecticide', 'unit' => 'Bottle 50ml', 'net' => '50 ml', 'price' => '1900', 'cost' => '1450', 'pack' => 'bottle', 'size_class' => 's', 'color' => '#AD1457', 'image' => 'belt-480sc', 'demand' => 3, 'restock' => 30],
        ['name' => 'Coragen 20SC', 'brand' => 'Coragen', 'formulation' => '20 SC', 'active' => 'Chlorantraniliprole', 'company' => 'FMC', 'category' => 'Insecticide', 'unit' => 'Bottle 50ml', 'net' => '50 ml', 'price' => '2400', 'cost' => '1850', 'pack' => 'bottle', 'size_class' => 's', 'color' => '#00695C', 'image' => 'coragen-20sc', 'demand' => 4, 'restock' => 36],
        ['name' => 'Talstar 10EC', 'brand' => 'Talstar', 'formulation' => '10 EC', 'active' => 'Bifenthrin', 'company' => 'FMC', 'category' => 'Insecticide', 'unit' => 'Bottle 250ml', 'net' => '250 ml', 'price' => '980', 'cost' => '740', 'pack' => 'bottle', 'size_class' => 'm', 'color' => '#4527A0', 'image' => 'talstar-10ec', 'demand' => 3, 'restock' => 36],
        ['name' => 'Lorsban 40EC', 'brand' => 'Lorsban', 'formulation' => '40 EC', 'active' => 'Chlorpyrifos', 'company' => 'Corteva Agriscience', 'category' => 'Insecticide', 'unit' => 'Bottle 1L', 'net' => '1 Litre', 'price' => '2200', 'cost' => '1700', 'pack' => 'bottle', 'size_class' => 'l', 'color' => '#D84315', 'image' => 'lorsban-40ec', 'demand' => 3, 'restock' => 24],
        ['name' => 'Radiant 120SC', 'brand' => 'Radiant', 'formulation' => '120 SC', 'active' => 'Spinetoram', 'company' => 'Corteva Agriscience', 'category' => 'Insecticide', 'unit' => 'Bottle 50ml', 'net' => '50 ml', 'price' => '2300', 'cost' => '1780', 'pack' => 'bottle', 'size_class' => 's', 'color' => '#0277BD', 'image' => 'radiant-120sc', 'demand' => 2, 'restock' => 18],
        ['name' => 'Tracer 240SC', 'brand' => 'Tracer', 'formulation' => '240 SC', 'active' => 'Spinosad', 'company' => 'Corteva Agriscience', 'category' => 'Insecticide', 'unit' => 'Bottle 50ml', 'net' => '50 ml', 'price' => '2600', 'cost' => '2000', 'pack' => 'bottle', 'size_class' => 's', 'color' => '#558B2F', 'image' => 'tracer-240sc', 'demand' => 2, 'restock' => 18],
        ['name' => 'Ulala 50WG', 'brand' => 'Ulala', 'formulation' => '50 WG', 'active' => 'Flonicamid', 'company' => 'UPL', 'category' => 'Insecticide', 'unit' => 'Pouch 60g', 'net' => '60 g', 'price' => '1450', 'cost' => '1100', 'pack' => 'pouch', 'color' => '#F9A825', 'image' => 'ulala-50wg', 'demand' => 2, 'restock' => 24],

        // ---- Herbicide ------------------------------------------------------------------
        ['name' => 'Gramoxone 20SL', 'brand' => 'Gramoxone', 'formulation' => '20 SL', 'active' => 'Paraquat dichloride', 'company' => 'Syngenta', 'category' => 'Herbicide', 'unit' => 'Can 1L', 'net' => '1 Litre', 'price' => '1800', 'cost' => '1400', 'pack' => 'jerrycan', 'color' => '#E65100', 'image' => 'gramoxone-20sl', 'demand' => 4, 'restock' => 36],
        ['name' => 'Roundup 490SL', 'brand' => 'Roundup', 'formulation' => '490 SL', 'active' => 'Glyphosate', 'company' => 'Bayer CropScience', 'category' => 'Herbicide', 'unit' => 'Can 1L', 'net' => '1 Litre', 'price' => '2100', 'cost' => '1650', 'pack' => 'jerrycan', 'color' => '#2E7D32', 'image' => 'roundup-490sl', 'demand' => 4, 'restock' => 36],
        ['name' => 'Topik 15WP', 'brand' => 'Topik', 'formulation' => '15 WP', 'active' => 'Clodinafop-propargyl', 'company' => 'Syngenta', 'category' => 'Herbicide', 'unit' => 'Pouch 100g', 'net' => '100 g', 'price' => '1450', 'cost' => '1100', 'pack' => 'pouch', 'color' => '#1976D2', 'image' => 'topik-15wp', 'demand' => 3, 'restock' => 36],
        ['name' => 'Axial 100EC', 'brand' => 'Axial', 'formulation' => '100 EC', 'active' => 'Pinoxaden', 'company' => 'Syngenta', 'category' => 'Herbicide', 'unit' => 'Bottle 250ml', 'net' => '250 ml', 'price' => '2750', 'cost' => '2150', 'pack' => 'bottle', 'size_class' => 'm', 'color' => '#5D4037', 'image' => 'axial-100ec', 'demand' => 2, 'restock' => 18],
        ['name' => 'Atlantis 3.6WG', 'brand' => 'Atlantis', 'formulation' => '3.6 WG', 'active' => 'Mesosulfuron + Iodosulfuron', 'company' => 'Bayer CropScience', 'category' => 'Herbicide', 'unit' => 'Box 160g', 'net' => '160 g', 'price' => '2650', 'cost' => '2050', 'pack' => 'box', 'color' => '#00796B', 'image' => 'atlantis-3-6wg', 'demand' => 2, 'restock' => 18],
        ['name' => 'Puma Super 75EW', 'brand' => 'Puma Super', 'formulation' => '75 EW', 'active' => 'Fenoxaprop-P-ethyl', 'company' => 'Bayer CropScience', 'category' => 'Herbicide', 'unit' => 'Bottle 500ml', 'net' => '500 ml', 'price' => '1850', 'cost' => '1420', 'pack' => 'bottle', 'size_class' => 'l', 'color' => '#C2185B', 'image' => 'puma-super-75ew', 'demand' => 2, 'restock' => 24],
        ['name' => 'Logran Extra 64WG', 'brand' => 'Logran Extra', 'formulation' => '64 WG', 'active' => 'Triasulfuron + Terbutryn', 'company' => 'Syngenta', 'category' => 'Herbicide', 'unit' => 'Box 400g', 'net' => '400 g', 'price' => '1700', 'cost' => '1300', 'pack' => 'box', 'color' => '#388E3C', 'image' => 'logran-extra-64wg', 'demand' => 2, 'restock' => 18],
        ['name' => 'Dual Gold 960EC', 'brand' => 'Dual Gold', 'formulation' => '960 EC', 'active' => 'S-Metolachlor', 'company' => 'Syngenta', 'category' => 'Herbicide', 'unit' => 'Bottle 800ml', 'net' => '800 ml', 'price' => '2400', 'cost' => '1850', 'pack' => 'bottle', 'size_class' => 'l', 'color' => '#F57F17', 'image' => 'dual-gold-960ec', 'demand' => 2, 'restock' => 18],
        ['name' => 'Stomp 455CS', 'brand' => 'Stomp', 'formulation' => '455 CS', 'active' => 'Pendimethalin', 'company' => 'BASF', 'category' => 'Herbicide', 'unit' => 'Can 1L', 'net' => '1 Litre', 'price' => '2300', 'cost' => '1780', 'pack' => 'jerrycan', 'color' => '#0288D1', 'image' => 'stomp-455cs', 'demand' => 3, 'restock' => 24],

        // ---- Fungicide ------------------------------------------------------------------
        ['name' => 'Score 250EC', 'brand' => 'Score', 'formulation' => '250 EC', 'active' => 'Difenoconazole', 'company' => 'Syngenta', 'category' => 'Fungicide', 'unit' => 'Bottle 100ml', 'net' => '100 ml', 'price' => '1150', 'cost' => '870', 'pack' => 'bottle', 'size_class' => 's', 'color' => '#FF8F00', 'image' => 'score-250ec', 'demand' => 3, 'restock' => 30],
        ['name' => 'Amistar Top 325SC', 'brand' => 'Amistar Top', 'formulation' => '325 SC', 'active' => 'Azoxystrobin + Difenoconazole', 'company' => 'Syngenta', 'category' => 'Fungicide', 'unit' => 'Bottle 200ml', 'net' => '200 ml', 'price' => '2800', 'cost' => '2180', 'pack' => 'bottle', 'size_class' => 'm', 'color' => '#303F9F', 'image' => 'amistar-top-325sc', 'demand' => 3, 'restock' => 24],
        ['name' => 'Ridomil Gold 68WG', 'brand' => 'Ridomil Gold', 'formulation' => '68 WG', 'active' => 'Metalaxyl-M + Mancozeb', 'company' => 'Syngenta', 'category' => 'Fungicide', 'unit' => 'Pouch 250g', 'net' => '250 g', 'price' => '1600', 'cost' => '1230', 'pack' => 'pouch', 'color' => '#7B1FA2', 'image' => 'ridomil-gold-68wg', 'demand' => 3, 'restock' => 30],
        ['name' => 'Nativo 75WG', 'brand' => 'Nativo', 'formulation' => '75 WG', 'active' => 'Tebuconazole + Trifloxystrobin', 'company' => 'Bayer CropScience', 'category' => 'Fungicide', 'unit' => 'Pouch 100g', 'net' => '100 g', 'price' => '1350', 'cost' => '1030', 'pack' => 'pouch', 'color' => '#6A1B9A', 'image' => 'nativo-75wg', 'demand' => 3, 'restock' => 30],
        ['name' => 'Antracol 70WP', 'brand' => 'Antracol', 'formulation' => '70 WP', 'active' => 'Propineb', 'company' => 'Bayer CropScience', 'category' => 'Fungicide', 'unit' => 'Bag 500g', 'net' => '500 g', 'price' => '1250', 'cost' => '950', 'pack' => 'bag', 'color' => '#FBC02D', 'image' => 'antracol-70wp', 'demand' => 3, 'restock' => 30],
        ['name' => 'Cabrio Top 60WG', 'brand' => 'Cabrio Top', 'formulation' => '60 WG', 'active' => 'Pyraclostrobin + Metiram', 'company' => 'BASF', 'category' => 'Fungicide', 'unit' => 'Pouch 500g', 'net' => '500 g', 'price' => '2200', 'cost' => '1700', 'pack' => 'pouch', 'color' => '#0097A7', 'image' => 'cabrio-top-60wg', 'demand' => 2, 'restock' => 18],
        ['name' => 'Dithane M-45', 'brand' => 'Dithane M-45', 'formulation' => '80 WP', 'active' => 'Mancozeb', 'company' => 'Corteva Agriscience', 'category' => 'Fungicide', 'unit' => 'Bag 1kg', 'net' => '1 kg', 'price' => '1400', 'cost' => '1060', 'pack' => 'bag', 'color' => '#FF7043', 'image' => 'dithane-m-45', 'demand' => 4, 'restock' => 40],
        ['name' => 'Topsin-M 70WP', 'brand' => 'Topsin-M', 'formulation' => '70 WP', 'active' => 'Thiophanate-methyl', 'company' => 'UPL', 'category' => 'Fungicide', 'unit' => 'Pouch 250g', 'net' => '250 g', 'price' => '1300', 'cost' => '980', 'pack' => 'pouch', 'color' => '#43A047', 'image' => 'topsin-m-70wp', 'demand' => 2, 'restock' => 24],

        // ---- Rodenticide ----------------------------------------------------------------
        ['name' => 'Storm Wax Block', 'brand' => 'Storm', 'formulation' => 'Wax Block', 'active' => 'Flocoumafen 0.005%', 'company' => 'BASF', 'category' => 'Rodenticide', 'unit' => 'Box 8 blocks', 'net' => '8 blocks', 'price' => '650', 'cost' => '480', 'pack' => 'box', 'color' => '#B71C1C', 'image' => 'storm-wax-block', 'demand' => 2, 'restock' => 30],
        ['name' => 'Racumin Tracking Powder', 'brand' => 'Racumin', 'formulation' => 'Tracking Powder', 'active' => 'Coumatetralyl 0.75%', 'company' => 'Bayer CropScience', 'category' => 'Rodenticide', 'unit' => 'Box 100g', 'net' => '100 g', 'price' => '550', 'cost' => '410', 'pack' => 'box', 'color' => '#455A64', 'image' => 'racumin-tracking-powder', 'demand' => 2, 'restock' => 24],
        ['name' => 'Zinc Phosphide 80%', 'brand' => 'Zinc Phosphide', 'formulation' => '80% DP', 'active' => 'Zinc phosphide', 'company' => 'Ali Akbar Group', 'category' => 'Rodenticide', 'unit' => 'Pouch 50g', 'net' => '50 g', 'price' => '350', 'cost' => '250', 'pack' => 'pouch', 'color' => '#37474F', 'image' => 'zinc-phosphide-80', 'demand' => 2, 'restock' => 40],

        // ---- Micronutrient --------------------------------------------------------------
        ['name' => 'Zinc Sulphate 33%', 'brand' => 'Zinc Sulphate', 'formulation' => '33% Zn', 'active' => 'Monohydrate granules', 'company' => 'Ali Akbar Group', 'category' => 'Micronutrient', 'unit' => 'Bag 3kg', 'net' => '3 kg', 'price' => '1150', 'cost' => '870', 'pack' => 'bag', 'color' => '#546E7A', 'image' => 'zinc-sulphate-33', 'demand' => 3, 'restock' => 40],
        ['name' => 'Boron 17%', 'brand' => 'Boron', 'formulation' => '17% B', 'active' => 'Boric acid', 'company' => 'Ali Akbar Group', 'category' => 'Micronutrient', 'unit' => 'Bag 1kg', 'net' => '1 kg', 'price' => '750', 'cost' => '560', 'pack' => 'bag', 'color' => '#8D6E63', 'image' => 'boron-17', 'demand' => 2, 'restock' => 30],
        ['name' => 'Isabion', 'brand' => 'Isabion', 'formulation' => 'Biostimulant', 'active' => 'Amino acids & peptides', 'company' => 'Syngenta', 'category' => 'Micronutrient', 'unit' => 'Bottle 1L', 'net' => '1 Litre', 'price' => '3200', 'cost' => '2500', 'pack' => 'bottle', 'size_class' => 'l', 'color' => '#00897B', 'image' => 'isabion', 'demand' => 2, 'restock' => 12],
        ['name' => 'Ferti-Max NPK 20-20-20', 'brand' => 'Ferti-Max', 'formulation' => 'NPK 20-20-20', 'active' => 'Water-soluble fertilizer', 'company' => 'Jaffer Agro Services', 'category' => 'Micronutrient', 'unit' => 'Bag 1kg', 'net' => '1 kg', 'price' => '650', 'cost' => '480', 'pack' => 'bag', 'color' => '#1E88E5', 'image' => 'ferti-max-npk', 'demand' => 3, 'restock' => 40],

        // ---- Plant Growth Regulator -----------------------------------------------------
        ['name' => 'Ethrel 39.6SL', 'brand' => 'Ethrel', 'formulation' => '39.6 SL', 'active' => 'Ethephon', 'company' => 'Bayer CropScience', 'category' => 'Plant Growth Regulator', 'unit' => 'Bottle 250ml', 'net' => '250 ml', 'price' => '1350', 'cost' => '1030', 'pack' => 'bottle', 'size_class' => 'm', 'color' => '#E53935', 'image' => 'ethrel-39-6sl', 'demand' => 1, 'restock' => 6],
        ['name' => 'Agromin Gold', 'brand' => 'Agromin Gold', 'formulation' => 'Chelated', 'active' => 'Zn, Fe, Mn, B micronutrients', 'company' => 'Jaffer Agro Services', 'category' => 'Plant Growth Regulator', 'unit' => 'Bottle 500ml', 'net' => '500 ml', 'price' => '980', 'cost' => '740', 'pack' => 'bottle', 'size_class' => 'l', 'color' => '#FDD835', 'image' => 'agromin-gold', 'demand' => 2, 'restock' => 24],
    ],
];
