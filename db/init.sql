CREATE DATABASE carrentals;

USE carrentals;

-- COUNTRY
CREATE TABLE IF NOT EXISTS country (
    countryId INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(45) NOT NULL,
    code VARCHAR(3) NOT NULL,
    PRIMARY KEY (countryId)
);

INSERT INTO TABLE country (countryId, name, code) VALUES
    (1, "Portugal", "PRT"),
    (2, "Canada", "CAN"),
    (3, "Angola", "AGO"),
    (4, "Brazil", "BRA");

-- ADDRESS
CREATE TABLE IF NOT EXISTS address (
    addressId INT UNSIGNED NOT NULL AUTO_INCREMENT,
    street VARCHAR(90) NOT NULL,
    doorNumber VARCHAR(10),
    apartmentNr VARCHAR(10),
    city VARCHAR(45) NOT NULL,
    district VARCHAR(45) NOT NULL,
    postalCode VARCHAR(15) NOT NULL,
    country_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (addressId),
    CONSTRAINT fk_address_country
        FOREIGN KEY (country_id)
        REFERENCES country(countryId)
);

INSERT INTO address (
    addressId,
    street,
    doorNumber,
    apartmentNr,
    city,
    district,
    postalCode
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
);

-- ISLAND
CREATE TABLE IF NOT EXISTS island (
    islandId INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(45) NOT NULL
);

INSERT INTO island (
    islandId,
    name
) VALUES (
    1,
    "São Miguel"
), (
    2,
    "Santa Maria"
);

-- LOCATION
CREATE TABLE location (
    locationId INT UNSIGNED NOT NULL AUTO_INCREMENT,
    address_id INT UNSIGNED NOT NULL,
    island_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (locationId),
    CONSTRAINT fk_location_address
        FOREIGN KEY (address_id)
        REFERENCES address(addressId),
    CONSTRAINT fk_location_island
        FOREIGN KEY (island_id)
        REFERENCES address(islandId)
);

INSERT INTO location (
    locationId, address_id, island_id
) VALUES (
    1, 1, 1
), (
    2, 2, 1
), (
    3, 3, 1
), (
    4, 4, 2
), (
    5, 5, 2
);

-- PROPERTY
CREATE TABLE IF NOT EXISTS property (
    propertyId INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(45) NOT NULL
);

-- TODO: FIX SIMILAR MODEL
INSERT INTO property (
    propertyId, name
) VALUES (
    -- CAR PROPERTIES
    1, "brand"
), (
    2, "model"
), (
    3, "color"
), (
    4, "year"
), (
    5, "similarModel"
), (
    -- CATEGORY PROPERTIES
    6, "transmission"
), (
    7, "fuel"
), (
    8, "seats"
), (
    9, "doors"
), (
    10, "trunkSize"
);

-- CATEGORY
CREATE TABLE IF NOT EXISTS category (
    idCategory INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(45) NOT NULL,
    description VARCHAR(90) NOT NULL,
    dailyRate FLOAT(2) NOT NULL
);

INSERT INTO category (
    idCategory,
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

-- VEHICLE
CREATE TABLE IF NOT EXISTS vehicle (
    vehicleId INT UNSIGNED NOT NULL AUTO_INCREMENT,
    plate VARCHAR(10) NOT NULL,
    category_id INT UNSIGNED NOT NULL,
    rentable BOOLEAN NOT NULL,
    island_id INT UNSIGNED NOT NULL,
    exampleModel VARCHAR(45) NOT NULL,
    PRIMARY KEY (vehicleId),
    CONSTRAINT fk_vehicle_category
        FOREIGN KEY (category_id)
        REFERENCES category(categoryId),
    CONSTRAINT fk_vehicle_island
        FOREIGN KEY (island_id)
        REFERENCES island(islandId)
);

INSERT INTO vehicle (plate, category_id, rentable, island_id, exampleModel)
    VALUES
    -- Economy Cars - São Miguel
    ("SM-AB12-CD", 1, TRUE, 1, "Renault Clio"),
    ("SM-EF34-GH", 1, TRUE, 1, "Volkswagen Polo"),
    ("SM-IJ56-KL", 1, TRUE, 1, "Ford Fiesta"),

    -- Small Cars - São Miguel
    ("SM-MN78-OP", 2, TRUE, 1, "Fiat 500"),
    ("SM-QR90-ST", 2, TRUE, 1, "Toyota Yaris"),
    ("SM-UV12-WX", 2, TRUE, 1, "Honda Fit"),

    -- Sedan Cars - São Miguel
    ("SM-YZ34-AB", 3, TRUE, 1, "Toyota Corolla"),
    ("SM-CD56-EF", 3, TRUE, 1, "Honda Civic"),
    ("SM-GH78-IJ", 3, TRUE, 1, "Nissan Sentra"),

    -- SUV Cars - São Miguel
    ("SM-KL90-MN", 4, TRUE, 1, "Toyota RAV4"),
    ("SM-OP12-QR", 4, TRUE, 1, "Nissan Rogue"),
    ("SM-ST34-UV", 4, TRUE, 1, "Ford Escape"),

    -- Sedan Premium Cars - São Miguel
    ("SM-WX56-YZ", 5, TRUE, 1, "BMW 3 Series"),
    ("SM-AB78-CD", 5, TRUE, 1, "Mercedes-Benz C-Class"),
    ("SM-EF90-GH", 5, TRUE, 1, "Audi A4"),

    -- SUV Premium Cars - São Miguel
    ("SM-IJ12-KL", 6, TRUE, 1, "Range Rover Sport"),
    ("SM-MN34-OP", 6, TRUE, 1, "Porsche Cayenne"),
    ("SM-QR56-ST", 6, TRUE, 1, "BMW X5"),

    -- Electric Cars - São Miguel
    ("SM-UV78-WX", 7, TRUE, 1, "Tesla Model 3"),
    ("SM-YZ90-AB", 7, TRUE, 1, "Nissan Leaf"),
    ("SM-CD12-EF", 7, TRUE, 1, "Chevrolet Bolt"),

    -- Economy Cars - Santa Maria
    ("SMa-AB34-CD", 1, TRUE, 2, "Renault Clio"),
    ("SMa-EF56-GH", 1, TRUE, 2, "Volkswagen Polo"),
    ("SMa-IJ78-KL", 1, TRUE, 2, "Ford Fiesta"),

    -- Small Cars - Santa Maria
    ("SMa-MN90-OP", 2, TRUE, 2, "Fiat 500"),
    ("SMa-QR12-ST", 2, TRUE, 2, "Toyota Yaris"),
    ("SMa-UV34-WX", 2, TRUE, 2, "Honda Fit"),

    -- Sedan Cars - Santa Maria 
    ("SMa-YZ56-AB", 3, TRUE, 2, "Toyota Corolla"),
    ("SMa-CD78-EF", 3, TRUE, 2, "Honda Civic"),
    ("SMa-GH90-IJ", 3, TRUE, 2, "Nissan Sentra"),

    -- SUV Cars - Santa Maria
    ("SMa-KL12-MN", 4, TRUE, 2, "Toyota RAV4"),
    ("SMa-OP34-QR", 4, TRUE, 2, "Nissan Rogue"),
    ("SMa-ST56-UV", 4, TRUE, 2, "Ford Escape"),

    -- Sedan Premium Cars - Santa Maria
    ("SMa-WX78-YZ", 5, TRUE, 2, "BMW 3 Series"),
    ("SMa-AB90-CD", 5, TRUE, 2, "Mercedes-Benz C-Class"),
    ("SMa-EF12-GH", 5, TRUE, 2, "Audi A4"),

    -- SUV Premium Cars - Santa Maria
    ("SMa-IJ34-KL", 6, TRUE, 2, "Range Rover Sport"),
    ("SMa-MN56-OP", 6, TRUE, 2, "Porsche Cayenne"),
    ("SMa-QR78-ST", 6, TRUE, 2, "BMW X5"),

    -- Electric Cars - Santa Maria
    ("SMa-UV90-WX", 7, TRUE, 2, "Tesla Model 3"),
    ("SMa-YZ12-AB", 7, TRUE, 2, "Nissan Leaf"),
    ("SMa-CD34-EF", 7, TRUE, 2, "Chevrolet Bolt");

-- VEHICLE PROPERTIES
CREATE TABLE IF NOT EXISTS vehicle_property (
    vehicle_id INT UNSIGNED NOT NULL,
    property_id INT UNSIGNED NOT NULL,
    value VARCHAR(45) NOT NULL,
    PRIMARY KEY (vehicle_id, property_id),
    CONSTRAINT fk_vehicle_property_vehicle
        FOREIGN KEY (vehicle_id)
        REFERENCES vehicle(vehicleId),
    CONSTRAINT fk_vehicle_property_property
        FOREIGN KEY (property_id)
        REFERENCES property(propertyId)
);

INSERT INTO vehicle_property (vehicle_id, property_id, value, similarModel)
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

-- Small Cars - São Miguel
(4, 1, "Fiat"),
(4, 2, "500"),
(4, 3, "Yellow"),
(4, 4, "2022"),
(5, 5, "Honda Fit"),

(5, 1, "Toyota"),
(5, 2, "Yaris"),
(5, 3, "Silver"),
(5, 4, "2022"),
(5, 5, "Fiat 500"),

(6, 1, "Honda"),
(6, 2, "Fit"),
(6, 3, "Green"),
(6, 4, "2022"),
(6, 5, "Fiat 500"),

-- Sedan Cars - São Miguel
(7, 1, "Toyota"),
(7, 2, "Corolla"),
(7, 3, "Black"),
(7, 4, "2022"),
(7, 5, "Honda Civic"),

(8, 1, "Honda"),
(8, 2, "Civic"),
(8, 3, "Gray"),
(8, 4, "2022"),
(8, 5, "Toyota Corolla"),

(9, 1, "Nissan"),
(9, 2, "Sentra"),
(9, 3, "Blue"),
(9, 4, "2022"),
(9, 5, "Honda Civic"),

-- SUV Cars - São Miguel
(10, 1, "Toyota"),
(10, 2, "RAV4"),
(10, 3, "Silver"),
(10, 4, "2022"),
(10, 5, "Nissan Rogue"),

(11, 1, "Nissan"),
(11, 2, "Rogue"),
(11, 3, "Red"),
(11, 4, "2022"),
(11, 5, "Toyota RAV4"),

(12, 1, "Ford"),
(12, 2, "Escape"),
(12, 3, "Green"),
(12, 4, "2022"),
(12, 5, "Toyota RAV4"),

-- Sedan Premium Cars - São Miguel
(13, 1, "BMW"),
(13, 2, "3 Series"),
(13, 3, "Black"),
(13, 4, "2022"),
(13, 5, "Audi A4"),

(14, 1, "Mercedes-Benz"),
(14, 2, "C-Class"),
(14, 3, "White"),
(14, 4, "2022"),
(14, 5, "Audi A4"),

(15, 1, "Audi"),
(15, 2, "A4"),
(15, 3, "Silver"),
(15, 4, "2022"),
(15, 5, "BMW 3 Series"),

-- SUV Premium Cars - São Miguel
(16, 1, "Range Rover"),
(16, 2, "Sport"),
(16, 3, "Blue"),
(16, 4, "2022"),
(16, 5, "BMW X5"),

(17, 1, "Porsche"),
(17, 2, "Cayenne"),
(17, 3, "Black"),
(17, 4, "2022"),
(17, 5, "BMW X5"),

(18, 1, "BMW"),
(18, 2, "X5"),
(18, 3, "Gray"),
(18, 4, "2022"),
(18, 5, "Porsche Cayenne"),

-- Electric Cars - São Miguel
(19, 1, "Tesla"),
(19, 2, "Model 3"),
(19, 3, "Red"),
(19, 4, "2022"),
(19, 5, "Nissan Leaf"),

(20, 1, "Nissan"),
(20, 2, "Leaf"),
(20, 3, "Silver"),
(20, 4, "2022"),
(20, 5, "Tesla Model 3"),

(21, 1, "Chevrolet"),
(21, 2, "Bolt"),
(21, 3, "Blue"),
(21, 4, "2022"),
(21, 5, "Tesla Model 3"),

-- Economy Cars - Santa Maria
(22, 1, "Renault"),
(22, 2, "Clio"),
(22, 3, "Red"),
(22, 4, "2022"),
(22, 5, "Volkswagen Polo"),

(23, 1, "Volkswagen"),
(23, 2, "Polo"),
(23, 3, "Blue"),
(23, 4, "2022"),
(23, 5, "Ford Fiesta"),

(24, 1, "Ford"),
(24, 2, "Fiesta"),
(24, 3, "White"),
(24, 4, "2022"),
(24, 5, "Volkswagen Polo"),

-- Small Cars - Santa Maria
(25, 1, "Fiat"),
(25, 2, "500"),
(25, 3, "Yellow"),
(25, 4, "2022"),
(25, 5, "Honda Fit"),

(26, 1, "Toyota"),
(26, 2, "Yaris"),
(26, 3, "Silver"),
(26, 4, "2022"),
(26, 5, "Honda Fit"),

(27, 1, "Honda"),
(27, 2, "Fit"),
(27, 3, "Green"),
(27, 4, "2022"),
(27, 5, "Toyota Yaris"),

-- Sedan Cars - Santa Maria
(28, 1, "Toyota"),
(28, 2, "Corolla"),
(28, 3, "Black"),
(28, 4, "2022"),
(28, 5, "Honda Civic"),

(29, 1, "Honda"),
(29, 2, "Civic"),
(29, 3, "Gray"),
(29, 4, "2022"),
(29, 5, "Toyota Corolla"),

(30, 1, "Nissan"),
(30, 2, "Sentra"),
(30, 3, "Blue"),
(30, 4, "2022"),
(30, 5, "Honda Civic"),

-- SUV Cars - Santa Maria
(31, 1, "Toyota"),
(31, 2, "RAV4"),
(31, 3, "Silver"),
(31, 4, "2022"),
(31, 5, "Nissan Rogue"),

(32, 1, "Nissan"),
(32, 2, "Rogue"),
(32, 3, "Red"),
(32, 4, "2022"),
(32, 5, "Toyota RAV4"),

(33, 1, "Ford"),
(33, 2, "Escape"),
(33, 3, "Green"),
(33, 4, "2022"),
(33, 5, "Toyota RAV4"),

-- Sedan Premium Cars - Santa Maria
(34, 1, "BMW"),
(34, 2, "3 Series"),
(34, 3, "Black"),
(34, 4, "2022"),
(34, 5, "Audi A4"),

(35, 1, "Mercedes-Benz"),
(35, 2, "C-Class"),
(35, 3, "White"),
(35, 4, "2022"),
(35, 5, "Audi A4"),

(36, 1, "Audi"),
(36, 2, "A4"),
(36, 3, "Silver"),
(36, 4, "2022"),
(36, 5, "BMW 3 Series"),

-- SUV Premium Cars - Santa Maria
(37, 1, "Range Rover"),
(37, 2, "Sport"),
(37, 3, "Blue"),
(37, 4, "2022"),
(37, 5, "BMW X5"),

(38, 1, "Porsche"),
(38, 2, "Cayenne"),
(38, 3, "Black"),
(38, 4, "2022"),
(38, 5, "BMW X5"),

(39, 1, "BMW"),
(39, 2, "X5"),
(39, 3, "Gray"),
(39, 4, "2022"),
(39, 5, "Porsche Cayenne"),

-- Electric Cars - Santa Maria
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
(42, 5, "Tesla Model 3");

-- CATEGORY PROPERTIES
CREATE TABLE IF NOT EXISTS category_property (
    category_id INT UNSIGNED NOT NULL,
    property_id INT UNSIGNED NOT NULL,
    value VARCHAR(45) NOT NULL,
    PRIMARY KEY (category_id, property_id),
    CONSTRAINT fk_category_property_category
        FOREIGN KEY (category_id)
        REFERENCES category(categoryId),
    CONSTRAINT fk_category_property_property
        FOREIGN KEY (property_id)
        REFERENCES property(propertyId)
);

INSERT INTO category_property(category_id, property_id, value)
    VALUES
    -- ECONOMY
    (1, 6, "manual"),
    (1, 7, "gas"),
    (1, 8, "4"),
    (1, 9, "3"),
    (1, 10, "2"),

    -- SMALL
    (2, 6, "manual"),
    (2, 7, "gas"),
    (2, 8, "5"),
    (2, 9, "5"),
    (2, 10, "3"),

    -- SEDAN
    (3, 6, "manual"),
    (3, 7, "gas"),
    (3, 8, "5"),
    (3, 9, "5"),
    (3, 10, "4"),

    -- SUV
    (4, 6, "manual"),
    (4, 7, "gas"),
    (4, 8, "5"),
    (4, 9, "5"),
    (4, 10, "5"),

    -- SEDAN PREMIUM
    (5, 6, "automatic"),
    (5, 7, "gas"),
    (5, 8, "5"),
    (5, 9, "5"),
    (5, 10, "4"),

    -- SUV PREMIUM
    (6, 6, "automatic"),
    (6, 7, "gas"),
    (6, 8, "5"),
    (6, 9, "5"),
    (6, 10, "5"),

    -- ELECTRIC
    (7, 6, "automatic"),
    (7, 7, "electric"),
    (7, 8, "5"),
    (7, 9, "5"),
    (7, 10, "4");

-- USER
CREATE TABLE IF NOT EXISTS user (
    userId INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(90) NOT NULL,
    email VARCHAR(90) NOT NULL,
    dateOfBirth DATE NOT NULL,
    address_id INT UNSIGNED NOT NULL,
    phone VARCHAR(25) NOT NULL,
    username VARCHAR(90) NOT NULL,
    passwordHash VARCHAR(200) NOT NULL,
    isAdmin BOOLEAN NOT NULL DEFAULT FALSE,
    isArchived BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY(userId),
    CONSTRAINT fk_user_address
        FOREIGN KEY (address_id)
        REFERENCES address(addressId)
);

-- TODO: CREATE DEFAULT ADMIN USER


-- CUSTOMER
CREATE TABLE IF NOT EXISTS customer (
    customerId INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(90) NOT NULL,
    email VARCHAR(90) NOT NULL,
    dateOfBirth DATE NOT NULL,
    address_id INT UNSIGNED NOT NULL,
    phone VARCHAR(25) NOT NULL,
    driversLicense VARCHAR(90) NOT NULL,
    creditCard VARCHAR(20) NOT NULL,
    ccExpiry DATE NOT NULL,
    ccCVV VARCHAR(3) NOT NULL,
    taxNumber VARCHAR(20) NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    isAdmin BOOLEAN NOT NULL DEFAULT FALSE,
    isArchived BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY(customerId),
    CONSTRAINT fk_customer_address
        FOREIGN KEY (address_id)
        REFERENCES address(addressId),
    CONSTRAINT fk_customer_user
        FOREIGN KEY (user_id)
        REFERENCES user(userId)
);

-- STATUS (OF RESERVATION)
CREATE TABLE IF NOT EXISTS status {
    statusId INT UNSIGNED NOT NULL AUTO_INCREMENT,
    statusName VARCHAR(45) NOT NULL,
    PRIMARY KEY (statusId)
};

INSERT INTO status (statusId, statusName)
VALUES
(1, "Booked"),
(2, "Confirmed"),
(3, "Cancelled"),
(4, "Void");

-- RESERVATION
CREATE TABLE IF NOT EXISTS reservation (
    reservationId INT UNSIGNED NOT NULL AUTO_INCREMENT,
    category_id INT UNSIGNED NOT NULL,
    customer_id INT UNSIGNED NOT NULL,
    status_id INT UNSIGNED NOT NULL,
    pickupLocation_id INT UNSIGNED NOT NULL,
    dropoffLocation_id INT UNSIGNED NOT NULL,
    pickupDate DATE NOT NULL,
    dropoffDate DATE NOT NULL,
    pickupTime TIME NOT NULL,
    dropoffTime TIME NOT NULL,
    vehicle_id INT UNSIGNED NOT NULL,
    reservedByUser_id INT UNSIGNED NOT NULL,
    reservedDate DATE NOT NULL DEFAULT CURDATE(),
    dateReturned DATE NOT NULL,
    timeReturned TIME NOT NULL,
    returnedLocation_id INT UNSIGNED NOT NULL,
    collectedByUser_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (reservationId),
    CONSTRAINT fk_reservation_category
        FOREIGN KEY (category_id)
        REFERENCES category(categoryId),
    CONSTRAINT fk_reservation_customer
        FOREIGN KEY (customer_id)
        REFERENCES customer(customerId),
    CONSTRAINT fk_reservation_status
        FOREIGN KEY (status_id)
        REFERENCES status(statusId),
    CONSTRAINT fk_reservation_pickupLocation
        FOREIGN KEY (pickupLocation_id)
        REFERENCES location(locationId),
    CONSTRAINT fk_reservation_dropoffLocation
        FOREIGN KEY (droppoffLocation_id)
        REFERENCES location(locationId),
    CONSTRAINT fk_reservation_vehicle
        FOREIGN KEY (vehicle_id)
        REFERENCES vehicle(vehicleId),
    CONSTRAINT fk_reservation_user
        FOREIGN KEY (reservedByUser_id)
        REFERENCES user(userId),
    CONSTRAINT fk_reservation_returnedLocation
        FOREIGN KEY (returnedLocation_id)
        REFERENCES location(locationId),
    CONSTRAINT fk_reservation_collectedByUser
        FOREIGN KEY (collectedByUser_id)
        REFERENCES user(userId)
);

-- MODIFICATION (OF RESERVATION)
CREATE TABLE IF NOT EXISTS modification (
    modificationId INT UNSIGNED NOT NULL AUTO_INCREMENT,
    reservation_id INT UNSIGNED NOT NULL,
    category_id INT UNSIGNED NOT NULL,
    customer_id INT UNSIGNED NOT NULL,
    status_id INT UNSIGNED NOT NULL,
    pickupLocation_id INT UNSIGNED NOT NULL,
    dropoffLocation_id INT UNSIGNED NOT NULL,
    pickupDate DATE NOT NULL,
    dropoffDate DATE NOT NULL,
    pickupTime TIME NOT NULL,
    dropoffTime TIME NOT NULL,
    vehicle_id INT UNSIGNED NOT NULL,
    modifiedByUser_id INT UNSIGNED NOT NULL,
    modifiedDate DATE NOT NULL DEFAULT CURDATE(),
    PRIMARY KEY (modificationId),
    CONSTRAINT fk_modification_reservation
        FOREIGN KEY (reservation_id)
        REFERENCES reservation(reservationId),
    CONSTRAINT fk_modification_category
        FOREIGN KEY (category_id)
        REFERENCES category(categoryId),
    CONSTRAINT fk_modification_customer
        FOREIGN KEY (customer_id)
        REFERENCES customer(customerId),
    CONSTRAINT fk_modification_status
        FOREIGN KEY (status_id)
        REFERENCES status(statusId),
    CONSTRAINT fk_modification_pickupLocation
        FOREIGN KEY (pickupLocation_id)
        REFERENCES location(locationId),
    CONSTRAINT fk_modification_dropoffLocation
        FOREIGN KEY (droppoffLocation_id)
        REFERENCES location(locationId),
    CONSTRAINT fk_modification_vehicle
        FOREIGN KEY (vehicle_id)
        REFERENCES vehicle(vehicleId),
    CONSTRAINT fk_modification_user
        FOREIGN KEY (reservedByUser_id)
        REFERENCES user(userId)
);

-- CREATE TABLE distritos (iddistrito INT UNSIGNED NOT NULL AUTO_INCREMENT, nomedistrito
-- VARCHAR(45) NOT NULL, PRIMARY KEY(iddistrito));
