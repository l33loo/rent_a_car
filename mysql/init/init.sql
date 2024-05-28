-- CREATE DATABASE carrentals;

USE carrentals;

-- COUNTRY
CREATE TABLE IF NOT EXISTS country (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(45) NOT NULL,
    code VARCHAR(6) NOT NULL,
    PRIMARY KEY (id)
);

-- ADDRESS
CREATE TABLE IF NOT EXISTS address (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    street VARCHAR(90) NOT NULL,
    doorNumber VARCHAR(10),
    apartmentNr VARCHAR(10),
    city VARCHAR(45) NOT NULL,
    district VARCHAR(45) NOT NULL,
    postalCode VARCHAR(15) NOT NULL,
    country_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_address_country
        FOREIGN KEY (country_id)
        REFERENCES country(id)
);

-- ISLAND
CREATE TABLE IF NOT EXISTS island (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(45) NOT NULL
);

-- LOCATION
CREATE TABLE location (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(90) NOT NULL,
    address_id INT UNSIGNED NOT NULL,
    island_id INT UNSIGNED NOT NULL,
    isArchived BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY (id),
    CONSTRAINT fk_location_address
        FOREIGN KEY (address_id)
        REFERENCES address(id),
    CONSTRAINT fk_location_island
        FOREIGN KEY (island_id)
        REFERENCES island(id)
);

-- PROPERTY
CREATE TABLE IF NOT EXISTS property (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(45) NOT NULL
);

-- CATEGORY
CREATE TABLE IF NOT EXISTS category (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(45) NOT NULL,
    description VARCHAR(90) NOT NULL,
    dailyRate DECIMAL(5,2) NOT NULL,
    isArchived BOOLEAN NOT NULL DEFAULT FALSE
);

-- VEHICLE
CREATE TABLE IF NOT EXISTS vehicle (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    plate VARCHAR(15) NOT NULL,
    category_id INT UNSIGNED,
    rentable BOOLEAN NOT NULL,
    island_id INT UNSIGNED NOT NULL,
    isArchived BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY (id),
    CONSTRAINT fk_vehicle_category
        FOREIGN KEY (category_id)
        REFERENCES category(id),
    CONSTRAINT fk_vehicle_island
        FOREIGN KEY (island_id)
        REFERENCES island(id),
    CONSTRAINT UNIQUE (plate)
);

-- VEHICLE PROPERTIES
CREATE TABLE IF NOT EXISTS vehicle_property (
    vehicle_id INT UNSIGNED NOT NULL,
    property_id INT UNSIGNED NOT NULL,
    propertyValue VARCHAR(45) NOT NULL,
    PRIMARY KEY (vehicle_id, property_id),
    CONSTRAINT fk_vehicle_property_vehicle
        FOREIGN KEY (vehicle_id)
        REFERENCES vehicle(id),
    CONSTRAINT fk_vehicle_property_property
        FOREIGN KEY (property_id)
        REFERENCES property(id)
);

-- CATEGORY PROPERTIES
CREATE TABLE IF NOT EXISTS category_property (
    category_id INT UNSIGNED NOT NULL,
    property_id INT UNSIGNED NOT NULL,
    propertyValue VARCHAR(45) NOT NULL,
    PRIMARY KEY (category_id, property_id),
    CONSTRAINT fk_category_property_category
        FOREIGN KEY (category_id)
        REFERENCES category(id),
    CONSTRAINT fk_category_property_property
        FOREIGN KEY (property_id)
        REFERENCES property(id)
);

-- USER
CREATE TABLE IF NOT EXISTS user (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    -- TODO: make email unique
    email VARCHAR(90) NOT NULL,
    passwordHash VARCHAR(200) NOT NULL,
    name VARCHAR(90) NOT NULL,
    dateOfBirth DATE NOT NULL,
    address_id INT UNSIGNED NOT NULL,
    phone VARCHAR(25) NOT NULL,
    isAdmin BOOLEAN NOT NULL DEFAULT FALSE,
    isArchived BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY(id),
    CONSTRAINT fk_user_address
        FOREIGN KEY (address_id)
        REFERENCES address(id),
    CONSTRAINT UNIQUE (email)
);

-- CREDIT CARD
CREATE TABLE IF NOT EXISTS creditCard (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    ccNumber VARCHAR(16) NOT NULL,
    ccExpiry DATE NOT NULL,
    ccCVV VARCHAR(3) NOT NULL,
    PRIMARY KEY (id)
);

-- CUSTOMER
CREATE TABLE IF NOT EXISTS customer (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(90) NOT NULL,
    email VARCHAR(90) NOT NULL,
    dateOfBirth DATE NOT NULL,
    address_id INT UNSIGNED NOT NULL,
    phone VARCHAR(25) NOT NULL,
    driversLicense VARCHAR(90) NOT NULL,
    -- TODO: do we want credit card attached to the customer?
    -- Better with user, or just the reservation
    -- creditCard_id INT UNSIGNED NOT NULL,
    taxNumber VARCHAR(20),
    user_id INT UNSIGNED,
    isArchived BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY(id),
    CONSTRAINT fk_customer_address
        FOREIGN KEY (address_id)
        REFERENCES address(id),
    CONSTRAINT fk_customer_user
        FOREIGN KEY (user_id)
        REFERENCES user(id)
    -- CONSTRAINT fk_customer_creditCard
    --     FOREIGN KEY (creditCard_id)
    --     REFERENCES creditCard(id)
);

-- STATUS (OF RESERVATION)
CREATE TABLE IF NOT EXISTS status (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    statusName VARCHAR(45) NOT NULL,
    PRIMARY KEY (id)
);

-- RESERVATION
CREATE TABLE IF NOT EXISTS reservation (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    ownerUser_id INT UNSIGNED,
    PRIMARY KEY (id),
    CONSTRAINT fk_reservation_user
        FOREIGN KEY (ownerUser_id)
        REFERENCES user(id)
);

-- REVISION (of RESERVATION)
-- Keep all versions of a given reservation
CREATE TABLE IF NOT EXISTS revision (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    category_id INT UNSIGNED NOT NULL,
    customer_id INT UNSIGNED NOT NULL,
    status_id INT UNSIGNED NOT NULL,
    pickupLocation_id INT UNSIGNED NOT NULL,
    dropoffLocation_id INT UNSIGNED NOT NULL,
    pickupDate DATE NOT NULL,
    dropoffDate DATE NOT NULL,
    pickupTime TIME NOT NULL,
    dropoffTime TIME NOT NULL,
    totalPrice DECIMAL(6,2) NOT NULL,
    -- To be added by admin when customer picks up the car
    vehicle_id INT UNSIGNED NOT NULL,
    submittedByUser_id INT UNSIGNED,
    submittedTimestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    -- To be added by admin when customer picks up the car
    effectivePickupDate DATE,
    effectivePickupTime TIME,
    effectivePickupLocation_id INT UNSIGNED,
    givenByUser_id INT UNSIGNED,

    -- To be added by admin when customer returns the car
    effectiveDropoffDate DATE,
    effectiveDropoffTime TIME,
    effectiveDropoffLocation_id INT UNSIGNED,
    collectedByUser_id INT UNSIGNED,
    
    billingAddress_id INT UNSIGNED NOT NULL,
    creditCard_id INT UNSIGNED NOT NULL,
    reservation_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_revision_category
        FOREIGN KEY (category_id)
        REFERENCES category(id),
    CONSTRAINT fk_revision_customer
        FOREIGN KEY (customer_id)
        REFERENCES customer(id),
    CONSTRAINT fk_revision_status
        FOREIGN KEY (status_id)
        REFERENCES status(id),
    CONSTRAINT fk_revision_pickupLocation
        FOREIGN KEY (pickupLocation_id)
        REFERENCES location(id),
    CONSTRAINT fk_revision_dropoffLocation
        FOREIGN KEY (dropoffLocation_id)
        REFERENCES location(id),
    CONSTRAINT fk_revision_vehicle
        FOREIGN KEY (vehicle_id)
        REFERENCES vehicle(id),
    CONSTRAINT fk_revision_user
        FOREIGN KEY (submittedByUser_id)
        REFERENCES user(id),
    CONSTRAINT fk_revision_effectivePickupLocation
        FOREIGN KEY (effectivePickupLocation_id)
        REFERENCES location(id),
    CONSTRAINT fk_revision_effectiveDropoffLocation
        FOREIGN KEY (effectiveDropoffLocation_id)
        REFERENCES location(id),
    CONSTRAINT fk_revision_collectedByUser
        FOREIGN KEY (collectedByUser_id)
        REFERENCES user(id),
    CONSTRAINT fk_revision_givenByUser
        FOREIGN KEY (givenByUser_id)
        REFERENCES user(id),
    CONSTRAINT fk_revision_billingAddress
        FOREIGN KEY (billingAddress_id)
        REFERENCES address(id),
    CONSTRAINT fk_revision_creditCard
        FOREIGN KEY (creditCard_id)
        REFERENCES creditCard(id),
    CONSTRAINT fk_revision_reservation
        FOREIGN KEY (reservation_id)
        REFERENCES reservation(id)
);

-- POPULATE COUNTRY
INSERT INTO country (id, name, code) VALUES
    (1, "Portugal", "PRT"),
    (2, "Canada", "CAN"),
    (3, "Angola", "AGO"),
    (4, "Brazil", "BRA");

INSERT INTO address (
    id,
    street,
    doorNumber,
    apartmentNr,
    city,
    district,
    postalCode,
    country_id
) VALUES (
    1,
    "Aeroporto de Ponta Delgada",
    NULL,
    NULL,
    "Ponta Delgada",
    "São Miguel",
    "9500-749",
    1
), (
    2,
    "Campo de São Francisco",
    19,
    NULL,
    "Ponta Delgada",
    "São Miguel",
    "9500-153",
    1
), (
    3,
    "R. do Mourato",
    "70-A",
    NULL,
    "Ribeira Grande",
    "São Miguel",
    "9600-224",
    1
), (
    4,
    "Aeroporto de Santa Maria",
    NULL,
    NULL,
    "Vila do Porto",
    "Santa Maria",
    "9580-402",
    1
), (
    5, 
    "Salvaterra S/N",
    "26 CP",
    NULL,
    "Vila do Porto",
    "Santa Maria",
    "9580-486",
    1
), (
    6,
    "Rua Diego Mota",
    "1",
    "103",
    "Ponta Delgada",
    "São Miguel",
    "9500-123",
    1
), (
    7,
    "Rua Colonel Marcelo Cordeiro",
    "25",
    NULL,
    "Ribeira Grande",
    "São Miguel",
    "9600-999",
    1
);

INSERT INTO island (
    id,
    name
) VALUES (
    1,
    "São Miguel"
), (
    2,
    "Santa Maria"
);

INSERT INTO location (
    id, name, address_id, island_id
) VALUES (
    1, "Ponta Delgada - Aeroporto", 1, 1
), (
    2, "Ponta Delgada - Centro", 2, 1
), (
    3, "Ribeira Grande - Centro", 3, 1
), (
    4, "Vila do Porto - Aeroporto", 4, 2
), (
    5, "Vila do Porto - Centro", 5, 2
);

INSERT INTO property (
    id, name
) VALUES (
    -- CAR PROPERTIES
    1, "Brand"
), (
    2, "Model"
), (
    3, "Color"
), (
    4, "Year"
), (
    5, "Similar Model"
), (
    -- CATEGORY PROPERTIES
    6, "Transmission"
), (
    7, "Fuel"
), (
    8, "Seats"
), (
    9, "Doors"
), (
    10, "Trunk Size"
);

INSERT INTO category (
    id,
    name,
    description,
    dailyRate
) VALUES (
    1,
    "Economy",
    "Our most economical and fuel-efficient offerings",
    20.00
), (
    2,
    "Small",
    "Power in a small body",
    24.00
), (
    3,
    "Sedan",
    "Our manual sedans",
    30.00
), (
    4,
    "SUV",
    "Our manual sedans",
    32.00
), (
    5,
    "Sedan Premium",
    "Our automatic sedans",
    35.00
), (
    6,
    "SUV Premium",
    "Our automatic SUVs",
    38.00
), (
    7,
    "Electric",
    "Our electric cars",
    40.00
);

INSERT INTO vehicle (plate, category_id, rentable, island_id)
    VALUES
    -- Economy Cars - São Miguel
    ("SM-AB12-CD", 1, TRUE, 1),
    ("SM-EF34-GH", 1, TRUE, 1),
    ("SM-IJ56-KL", 1, TRUE, 1),
    ("SM-DF45-SD", 1, TRUE, 1),
    ("SM-SD86-HG", 1, TRUE, 1),
    ("SM-DF76-KD", 1, FALSE, 1),

    -- Small Cars - São Miguel
    ("SM-MN78-OP", 2, TRUE, 1),
    ("SM-QR90-ST", 2, TRUE, 1),
    ("SM-UV12-WX", 2, TRUE, 1),
    ("SM-YU34-GF", 2, TRUE, 1),
    ("SM-EE45-UI", 2, TRUE, 1),
    ("SM-YT32-YY", 2, TRUE, 1),

    -- Sedan Cars - São Miguel
    ("SM-YZ34-AB", 3, TRUE, 1),
    ("SM-CD56-EF", 3, TRUE, 1),
    ("SM-GH78-IJ", 3, TRUE, 1),
    ("SM-IU44-RT", 3, TRUE, 1),
    ("SM-QW23-ER", 3, TRUE, 1),
    ("SM-RR55-TT", 3, TRUE, 1),

    -- SUV Cars - São Miguel
    ("SM-KL90-MN", 4, TRUE, 1),
    ("SM-OP12-QR", 4, TRUE, 1),
    ("SM-ST34-UV", 4, TRUE, 1),
    ("SM-QW87-GF", 4, TRUE, 1),
    ("SM-PO45-PO", 4, TRUE, 1),
    ("SM-QQ90-SD", 4, TRUE, 1),

    -- Sedan Premium Cars - São Miguel
    ("SM-WX56-YZ", 5, TRUE, 1),
    ("SM-AB78-CD", 5, TRUE, 1),
    ("SM-EF90-GH", 5, TRUE, 1),
    ("SM-GH65-RQ", 5, TRUE, 1),
    ("SM-QW34-QW", 5, TRUE, 1),
    ("SM-DK83-QQ", 5, TRUE, 1),

    -- SUV Premium Cars - São Miguel
    ("SM-IJ12-KL", 6, TRUE, 1),
    ("SM-MN34-OP", 6, TRUE, 1),
    ("SM-QR56-ST", 6, TRUE, 1),
    ("SM-GF47-DF", 6, TRUE, 1),
    ("SM-DF32-PP", 6, TRUE, 1),
    ("SM-ER23-ER", 6, TRUE, 1),

    -- Electric Cars - São Miguel
    ("SM-UV78-WX", 7, TRUE, 1),
    ("SM-YZ90-AB", 7, TRUE, 1),
    ("SM-CD12-EF", 7, TRUE, 1),
    ("SM-SS23-SS", 7, TRUE, 1),
    ("SM-AA34-AA", 7, TRUE, 1),
    ("SM-TT65-TT", 7, TRUE, 1),

    -- Economy Cars - Santa Maria
    ("SMa-AB34-CD", 1, TRUE, 2),
    ("SMa-EF56-GH", 1, TRUE, 2),
    ("SMa-IJ78-KL", 1, TRUE, 2),
    ("SMa-GG97-GG", 1, TRUE, 2),
    ("SMa-HH12-HH", 1, TRUE, 2),
    ("SMa-YU45-UY", 1, TRUE, 2),

    -- Small Cars - Santa Maria
    ("SMa-MN90-OP", 2, TRUE, 2),
    ("SMa-QR12-ST", 2, TRUE, 2),
    ("SMa-UV34-WX", 2, TRUE, 2),
    ("SMa-HG98-HG", 2, TRUE, 2),
    ("SMa-AS34-SA", 2, TRUE, 2),
    ("SMa-FD63-UI", 2, TRUE, 2),

    -- Sedan Cars - Santa Maria 
    ("SMa-YZ56-AB", 3, TRUE, 2),
    ("SMa-CD78-EF", 3, TRUE, 2),
    ("SMa-GH90-IJ", 3, TRUE, 2),
    ("SMa-KQ73-QK", 3, TRUE, 2),
    ("SMa-CS78-EB", 3, TRUE, 2),
    ("SMa-GJ90-ID", 3, TRUE, 2),

    -- SUV Cars - Santa Maria
    ("SMa-KL12-MN", 4, TRUE, 2),
    ("SMa-OP34-QR", 4, TRUE, 2),
    ("SMa-ST56-UV", 4, TRUE, 2),
    ("SMa-SD70-FR", 4, TRUE, 2),
    ("SMa-WE34-EW", 4, TRUE, 2),
    ("SMa-WW12-WW", 4, TRUE, 2),

    -- Sedan Premium Cars - Santa Maria
    ("SMa-WX78-YZ", 5, TRUE, 2),
    ("SMa-AB90-CD", 5, TRUE, 2),
    ("SMa-EF12-GH", 5, TRUE, 2),
    ("SMa-HH72-RZ", 5, TRUE, 2),
    ("SMa-HG34-AG", 5, TRUE, 2),
    ("SMa-WE98-JG", 5, TRUE, 2),

    -- SUV Premium Cars - Santa Maria
    ("SMa-IJ34-KL", 6, TRUE, 2),
    ("SMa-MN56-OP", 6, TRUE, 2),
    ("SMa-QR78-ST", 6, TRUE, 2),
    ("SMa-LD84-PF", 6, TRUE, 2),
    ("SMa-AL11-FT", 6, TRUE, 2),
    ("SMa-JS85-PD", 6, TRUE, 2),

    -- Electric Cars - Santa Maria
    ("SMa-UV90-WX", 7, TRUE, 2),
    ("SMa-YZ12-AB", 7, TRUE, 2),
    ("SMa-CD34-EF", 7, TRUE, 2),
    ("SMa-KS74-JS", 7, TRUE, 2),
    ("SMa-PG43-AS", 7, TRUE, 2),
    ("SMa-KS75-ID", 7, TRUE, 2);

INSERT INTO vehicle_property (vehicle_id, property_id, propertyValue)
VALUES
-- Economy Cars - São Miguel
(1, 1, "Renault"),
(1, 2, "Clio"),
(1, 3, "Red"),
(1, 4, "2022"),
(1, 5, "Volkswagen Polo"),

(2, 1, "Volkswagen"),
(2, 2, "Polo"),
(2, 3, "Blue"),
(2, 4, "2022"),
(2, 5, "Renault Clio"),

(3, 1, "Ford"),
(3, 2, "Fiesta"),
(3, 3, "White"),
(3, 4, "2022"),
(3, 5, "Renault Clio"),

(4, 1, "Renault"),
(4, 2, "Clio"),
(4, 3, "Red"),
(4, 4, "2022"),
(4, 5, "Volkswagen Polo"),

(5, 1, "Volkswagen"),
(5, 2, "Polo"),
(5, 3, "Blue"),
(5, 4, "2022"),
(5, 5, "Renault Clio"),

(6, 1, "Ford"),
(6, 2, "Fiesta"),
(6, 3, "White"),
(6, 4, "2022"),
(6, 5, "Renault Clio"),

-- Small Cars - São Miguel
(7, 1, "Fiat"),
(7, 2, "500"),
(7, 3, "Yellow"),
(7, 4, "2022"),
(7, 5, "Honda Fit"),

(8, 1, "Toyota"),
(8, 2, "Yaris"),
(8, 3, "Silver"),
(8, 4, "2022"),
(8, 5, "Fiat 500"),

(9, 1, "Honda"),
(9, 2, "Fit"),
(9, 3, "Green"),
(9, 4, "2022"),
(9, 5, "Fiat 500"),

(10, 1, "Fiat"),
(10, 2, "500"),
(10, 3, "Yellow"),
(10, 4, "2022"),
(10, 5, "Honda Fit"),

(11, 1, "Toyota"),
(11, 2, "Yaris"),
(11, 3, "Silver"),
(11, 4, "2022"),
(11, 5, "Fiat 500"),

(12, 1, "Honda"),
(12, 2, "Fit"),
(12, 3, "Green"),
(12, 4, "2022"),
(12, 5, "Fiat 500"),

-- Sedan Cars - São Miguel
(13, 1, "Toyota"),
(13, 2, "Corolla"),
(13, 3, "Black"),
(13, 4, "2022"),
(13, 5, "Honda Civic"),

(14, 1, "Honda"),
(14, 2, "Civic"),
(14, 3, "Gray"),
(14, 4, "2022"),
(14, 5, "Toyota Corolla"),

(15, 1, "Nissan"),
(15, 2, "Sentra"),
(15, 3, "Blue"),
(15, 4, "2022"),
(15, 5, "Honda Civic"),

(16, 1, "Toyota"),
(16, 2, "Corolla"),
(16, 3, "Black"),
(16, 4, "2022"),
(16, 5, "Honda Civic"),

(17, 1, "Honda"),
(17, 2, "Civic"),
(17, 3, "Gray"),
(17, 4, "2022"),
(17, 5, "Toyota Corolla"),

(18, 1, "Nissan"),
(18, 2, "Sentra"),
(18, 3, "Blue"),
(18, 4, "2022"),
(18, 5, "Honda Civic"),

-- SUV Cars - São Miguel
(19, 1, "Toyota"),
(19, 2, "RAV4"),
(19, 3, "Silver"),
(19, 4, "2022"),
(19, 5, "Nissan Rogue"),

(20, 1, "Nissan"),
(20, 2, "Rogue"),
(20, 3, "Red"),
(20, 4, "2022"),
(20, 5, "Toyota RAV4"),

(21, 1, "Ford"),
(21, 2, "Escape"),
(21, 3, "Green"),
(21, 4, "2022"),
(21, 5, "Toyota RAV4"),

(22, 1, "Toyota"),
(22, 2, "RAV4"),
(22, 3, "Silver"),
(22, 4, "2022"),
(22, 5, "Nissan Rogue"),

(23, 1, "Nissan"),
(23, 2, "Rogue"),
(23, 3, "Red"),
(23, 4, "2022"),
(23, 5, "Toyota RAV4"),

(24, 1, "Ford"),
(24, 2, "Escape"),
(24, 3, "Green"),
(24, 4, "2022"),
(24, 5, "Toyota RAV4"),

-- Sedan Premium Cars - São Miguel
(25, 1, "BMW"),
(25, 2, "3 Series"),
(25, 3, "Black"),
(25, 4, "2022"),
(25, 5, "Audi A4"),

(26, 1, "Mercedes-Benz"),
(26, 2, "C-Class"),
(26, 3, "White"),
(26, 4, "2022"),
(26, 5, "Audi A4"),

(27, 1, "Audi"),
(27, 2, "A4"),
(27, 3, "Silver"),
(27, 4, "2022"),
(27, 5, "BMW 3 Series"),

(28, 1, "BMW"),
(28, 2, "3 Series"),
(28, 3, "Black"),
(28, 4, "2022"),
(28, 5, "Audi A4"),

(29, 1, "Mercedes-Benz"),
(29, 2, "C-Class"),
(29, 3, "White"),
(29, 4, "2022"),
(29, 5, "Audi A4"),

(30, 1, "Audi"),
(30, 2, "A4"),
(30, 3, "Silver"),
(30, 4, "2022"),
(30, 5, "BMW 3 Series"),

-- SUV Premium Cars - São Miguel
(31, 1, "Range Rover"),
(31, 2, "Sport"),
(31, 3, "Blue"),
(31, 4, "2022"),
(31, 5, "BMW X5"),

(32, 1, "Porsche"),
(32, 2, "Cayenne"),
(32, 3, "Black"),
(32, 4, "2022"),
(32, 5, "BMW X5"),

(33, 1, "BMW"),
(33, 2, "X5"),
(33, 3, "Gray"),
(33, 4, "2022"),
(33, 5, "Porsche Cayenne"),

(34, 1, "Range Rover"),
(34, 2, "Sport"),
(34, 3, "Blue"),
(34, 4, "2022"),
(34, 5, "BMW X5"),

(35, 1, "Porsche"),
(35, 2, "Cayenne"),
(35, 3, "Black"),
(35, 4, "2022"),
(35, 5, "BMW X5"),

(36, 1, "BMW"),
(36, 2, "X5"),
(36, 3, "Gray"),
(36, 4, "2022"),
(36, 5, "Porsche Cayenne"),

-- Electric Cars - São Miguel
(37, 1, "Tesla"),
(37, 2, "Model 3"),
(37, 3, "Red"),
(37, 4, "2022"),
(37, 5, "Nissan Leaf"),

(38, 1, "Nissan"),
(38, 2, "Leaf"),
(38, 3, "Silver"),
(38, 4, "2022"),
(38, 5, "Tesla Model 3"),

(39, 1, "Chevrolet"),
(39, 2, "Bolt"),
(39, 3, "Blue"),
(39, 4, "2022"),
(39, 5, "Tesla Model 3"),

(40, 1, "Tesla"),
(40, 2, "Model 3"),
(40, 3, "Red"),
(40, 4, "2022"),
(40, 5, "Nissan Leaf"),

(41, 1, "Nissan"),
(41, 2, "Leaf"),
(41, 3, "Silver"),
(41, 4, "2022"),
(41, 5, "Tesla Model 3"),

(42, 1, "Chevrolet"),
(42, 2, "Bolt"),
(42, 3, "Blue"),
(42, 4, "2022"),
(42, 5, "Tesla Model 3"),

-- Economy Cars - Santa Maria
(43, 1, "Renault"),
(43, 2, "Clio"),
(43, 3, "Red"),
(43, 4, "2022"),
(43, 5, "Volkswagen Polo"),

(44, 1, "Volkswagen"),
(44, 2, "Polo"),
(44, 3, "Blue"),
(44, 4, "2022"),
(44, 5, "Ford Fiesta"),

(45, 1, "Ford"),
(45, 2, "Fiesta"),
(45, 3, "White"),
(45, 4, "2022"),
(45, 5, "Volkswagen Polo"),

(46, 1, "Renault"),
(46, 2, "Clio"),
(46, 3, "Red"),
(46, 4, "2022"),
(46, 5, "Volkswagen Polo"),

(47, 1, "Volkswagen"),
(47, 2, "Polo"),
(47, 3, "Blue"),
(47, 4, "2022"),
(47, 5, "Ford Fiesta"),

(48, 1, "Ford"),
(48, 2, "Fiesta"),
(48, 3, "White"),
(48, 4, "2022"),
(48, 5, "Volkswagen Polo"),

-- Small Cars - Santa Maria
(49, 1, "Fiat"),
(49, 2, "500"),
(49, 3, "Yellow"),
(49, 4, "2022"),
(49, 5, "Honda Fit"),

(50, 1, "Toyota"),
(50, 2, "Yaris"),
(50, 3, "Silver"),
(50, 4, "2022"),
(50, 5, "Honda Fit"),

(51, 1, "Honda"),
(51, 2, "Fit"),
(51, 3, "Green"),
(51, 4, "2022"),
(51, 5, "Toyota Yaris"),

(52, 1, "Fiat"),
(52, 2, "500"),
(52, 3, "Yellow"),
(52, 4, "2022"),
(52, 5, "Honda Fit"),

(53, 1, "Toyota"),
(53, 2, "Yaris"),
(53, 3, "Silver"),
(53, 4, "2022"),
(53, 5, "Honda Fit"),

(54, 1, "Honda"),
(54, 2, "Fit"),
(54, 3, "Green"),
(54, 4, "2022"),
(54, 5, "Toyota Yaris"),

-- Sedan Cars - Santa Maria
(55, 1, "Toyota"),
(55, 2, "Corolla"),
(55, 3, "Black"),
(55, 4, "2022"),
(55, 5, "Honda Civic"),

(56, 1, "Honda"),
(56, 2, "Civic"),
(56, 3, "Gray"),
(56, 4, "2022"),
(56, 5, "Toyota Corolla"),

(57, 1, "Nissan"),
(57, 2, "Sentra"),
(57, 3, "Blue"),
(57, 4, "2022"),
(57, 5, "Honda Civic"),

(58, 1, "Toyota"),
(58, 2, "Corolla"),
(58, 3, "Black"),
(58, 4, "2022"),
(58, 5, "Honda Civic"),

(59, 1, "Honda"),
(59, 2, "Civic"),
(59, 3, "Gray"),
(59, 4, "2022"),
(59, 5, "Toyota Corolla"),

(60, 1, "Nissan"),
(60, 2, "Sentra"),
(60, 3, "Blue"),
(60, 4, "2022"),
(60, 5, "Honda Civic"),

-- SUV Cars - Santa Maria
(61, 1, "Toyota"),
(61, 2, "RAV4"),
(61, 3, "Silver"),
(61, 4, "2022"),
(61, 5, "Nissan Rogue"),

(62, 1, "Nissan"),
(62, 2, "Rogue"),
(62, 3, "Red"),
(62, 4, "2022"),
(62, 5, "Toyota RAV4"),

(63, 1, "Ford"),
(63, 2, "Escape"),
(63, 3, "Green"),
(63, 4, "2022"),
(63, 5, "Toyota RAV4"),

(64, 1, "Toyota"),
(64, 2, "RAV4"),
(64, 3, "Silver"),
(64, 4, "2022"),
(64, 5, "Nissan Rogue"),

(65, 1, "Nissan"),
(65, 2, "Rogue"),
(65, 3, "Red"),
(65, 4, "2022"),
(65, 5, "Toyota RAV4"),

(66, 1, "Ford"),
(66, 2, "Escape"),
(66, 3, "Green"),
(66, 4, "2022"),
(66, 5, "Toyota RAV4"),

-- Sedan Premium Cars - Santa Maria
(67, 1, "BMW"),
(67, 2, "3 Series"),
(67, 3, "Black"),
(67, 4, "2022"),
(67, 5, "Audi A4"),

(68, 1, "Mercedes-Benz"),
(68, 2, "C-Class"),
(68, 3, "White"),
(68, 4, "2022"),
(68, 5, "Audi A4"),

(69, 1, "Audi"),
(69, 2, "A4"),
(69, 3, "Silver"),
(69, 4, "2022"),
(69, 5, "BMW 3 Series"),

(70, 1, "BMW"),
(70, 2, "3 Series"),
(70, 3, "Black"),
(70, 4, "2022"),
(70, 5, "Audi A4"),

(71, 1, "Mercedes-Benz"),
(71, 2, "C-Class"),
(71, 3, "White"),
(71, 4, "2022"),
(71, 5, "Audi A4"),

(72, 1, "Audi"),
(72, 2, "A4"),
(72, 3, "Silver"),
(72, 4, "2022"),
(72, 5, "BMW 3 Series"),

-- SUV Premium Cars - Santa Maria
(73, 1, "Range Rover"),
(73, 2, "Sport"),
(73, 3, "Blue"),
(73, 4, "2022"),
(73, 5, "BMW X5"),

(74, 1, "Porsche"),
(74, 2, "Cayenne"),
(74, 3, "Black"),
(74, 4, "2022"),
(74, 5, "BMW X5"),

(75, 1, "BMW"),
(75, 2, "X5"),
(75, 3, "Gray"),
(75, 4, "2022"),
(75, 5, "Porsche Cayenne"),

(76, 1, "Range Rover"),
(76, 2, "Sport"),
(76, 3, "Blue"),
(76, 4, "2022"),
(76, 5, "BMW X5"),

(77, 1, "Porsche"),
(77, 2, "Cayenne"),
(77, 3, "Black"),
(77, 4, "2022"),
(77, 5, "BMW X5"),

(78, 1, "BMW"),
(78, 2, "X5"),
(78, 3, "Gray"),
(78, 4, "2022"),
(78, 5, "Porsche Cayenne"),

-- Electric Cars - Santa Maria
(79, 1, "Tesla"),
(79, 2, "Model 3"),
(79, 3, "Red"),
(79, 4, "2022"),
(79, 5, "Nissan Leaf"),

(80, 1, "Nissan"),
(80, 2, "Leaf"),
(80, 3, "Silver"),
(80, 4, "2022"),
(80, 5, "Tesla Model 3"),

(81, 1, "Chevrolet"),
(81, 2, "Bolt"),
(81, 3, "Blue"),
(81, 4, "2022"),
(81, 5, "Tesla Model 3"),

(82, 1, "Tesla"),
(82, 2, "Model 3"),
(82, 3, "Red"),
(82, 4, "2022"),
(82, 5, "Nissan Leaf"),

(83, 1, "Nissan"),
(83, 2, "Leaf"),
(83, 3, "Silver"),
(83, 4, "2022"),
(83, 5, "Tesla Model 3"),

(84, 1, "Chevrolet"),
(84, 2, "Bolt"),
(84, 3, "Blue"),
(84, 4, "2022"),
(84, 5, "Tesla Model 3");

INSERT INTO category_property(category_id, property_id, propertyValue)
    VALUES
    -- ECONOMY
    (1, 6, "Manual"),
    (1, 7, "Gas"),
    (1, 8, "4"),
    (1, 9, "3"),
    (1, 10, "2"),

    -- SMALL
    (2, 6, "Manual"),
    (2, 7, "Gas"),
    (2, 8, "5"),
    (2, 9, "5"),
    (2, 10, "3"),

    -- SEDAN
    (3, 6, "Manual"),
    (3, 7, "Gas"),
    (3, 8, "5"),
    (3, 9, "5"),
    (3, 10, "4"),

    -- SUV
    (4, 6, "Manual"),
    (4, 7, "Gas"),
    (4, 8, "5"),
    (4, 9, "5"),
    (4, 10, "5"),

    -- SEDAN PREMIUM
    (5, 6, "Automatic"),
    (5, 7, "Gas"),
    (5, 8, "5"),
    (5, 9, "5"),
    (5, 10, "4"),

    -- SUV PREMIUM
    (6, 6, "Automatic"),
    (6, 7, "Gas"),
    (6, 8, "5"),
    (6, 9, "5"),
    (6, 10, "5"),

    -- ELECTRIC
    (7, 6, "Automatic"),
    (7, 7, "Electric"),
    (7, 8, "5"),
    (7, 9, "5"),
    (7, 10, "4");

-- password = pass123
INSERT INTO user (id, email, passwordHash, name, dateOfBirth, address_id, phone, isAdmin)
VALUES
(
    1,
    "admin@superstar.pt",
    "$2y$10$XDDBRgYpxH5LfW5qf3FKpe2ZgJNoeY3a3JZOx6fzf3AlERmADnvEq",
    "Jane Doe",
    "1990-01-01",
    6,
    "916111222",
    TRUE
), (
    2,
    "user@email.pt",
    "$2y$10$XDDBRgYpxH5LfW5qf3FKpe2ZgJNoeY3a3JZOx6fzf3AlERmADnvEq",
    "Davide Soares",
    "1960-05-26",
    7,
    "999123321",
    FALSE
);

INSERT INTO creditCard (id, ccNumber, ccExpiry, ccCVV)
VALUES (
    1, "123456789", "2026-01-01", "666"
);

INSERT INTO customer (
    id,
    name,
    email,
    dateOfBirth,
    address_id,
    phone,
    driversLicense,
    taxNumber,
    user_id
) VALUES (
    1,
    "Empresa Vila Real",
    "davide@vilareal.pt",
    "1960-05-26",
    7,
    "123123123",
    "PT123999000",
    "222123123",
    2
);

INSERT INTO status (id, statusName)
VALUES
(1, "Confirmed"),
(2, "Modification Requested"),
(3, "Modification Declined"),
(4, "Cancelled"),
(5, "Payment Declined");

INSERT INTO reservation (id, ownerUser_id)
VALUES
    -- Created by Guest or Admin
    (1, NULL),
    -- Created by User
    (2, 2);

INSERT INTO revision (
    id,
    category_id,
    customer_id,
    status_id,
    pickupLocation_id,
    dropoffLocation_id,
    pickupDate,
    dropoffDate,
    pickupTime,
    dropoffTime,
    totalPrice,
    vehicle_id,
    submittedByUser_id,
    submittedTimestamp,
    effectivePickupDate,
    effectivePickupTime,
    effectivePickupLocation_id,
    givenByUser_id,
    effectiveDropoffDate,
    effectiveDropoffTime,
    effectiveDropoffLocation_id,
    collectedByUser_id,
    billingAddress_id,
    creditCard_id,
    reservation_id
) VALUES (
    1,
    2,
    1,
    1,
    1,
    1,
    '2024-08-01',
    '2024-08-10',
    '09:30:00',
    '09:30:00',
    100.00,
    1,
    2,
    '2024-05-20 15:23:21',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    1,
    1,
    1
), (
    2,
    4,
    1,
    1,
    2,
    2,
    '2024-05-24',
    '2024-06-07',
    '12:00:00',
    '10:30:00',
    350.00,
    20,
    2,
    '2024-03-20 11:06:24',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    1,
    1,
    2
), (
    3,
    4,
    1,
    2,
    2,
    2,
    '2024-05-24',
    '2024-06-07',
    '12:00:00',
    '10:30:00',
    350.00,
    19,
    2,
    '2024-05-24 12:06:36',
    '2024-05-24',
    '12:06:36',
    2,
    1,
    NULL,
    NULL,
    NULL,
    NULL,
    1,
    1,
    2
);