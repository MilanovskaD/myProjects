CREATE TABLE `admin`
(`id` INT NOT NULL AUTO_INCREMENT ,
 `username` VARCHAR(255) NOT NULL ,
 `password` VARCHAR(255) NOT NULL ,
 PRIMARY KEY (`id`));

INSERT INTO `admin`
    (`id`, `username`, `password`)
VALUES (NULL, 'admin', '$2y$10$rO9pbjtl3iG5W2mbEk2JQ.4Wytz2DLayiTSZVBUVcA2LwCE3cmt1u');

# password is admin

CREATE TABLE `vehicle_models`
(`id` INT NOT NULL AUTO_INCREMENT ,
 `vehicle_model` VARCHAR(255) NOT NULL ,
 PRIMARY KEY (`id`));

CREATE TABLE `vehicle_types`
(`id` INT NOT NULL AUTO_INCREMENT ,
 `vehicle_type` VARCHAR(255) NOT NULL ,
 PRIMARY KEY (`id`));

CREATE TABLE `fuel_types`
(`id` INT NOT NULL AUTO_INCREMENT ,
 `fuel_type` VARCHAR(255) NOT NULL ,
 PRIMARY KEY (`id`));


INSERT INTO `vehicle_models` (`vehicle_model`)
VALUES ('VW Golf 3'),
       ('Audi A3'),
       ('Toyota Corolla');

# starting vehicle models


INSERT INTO `fuel_types` (`fuel_type`)
VALUES ('gasoline'),
       ('diesel'),
       ('electric');

INSERT INTO `vehicle_types` (`vehicle_type`)
VALUES ('sedan'),
       ('coupe'),
       ('hatchback '),
       ('SUV'),
       ('minivan');

CREATE TABLE `registrations`
(`id` INT NOT NULL AUTO_INCREMENT ,
 `vehicle_model` VARCHAR(255) NOT NULL ,
 `vehicle_chassis` VARCHAR(255) NOT NULL ,
 `reg_num` VARCHAR(255) NOT NULL ,
 `reg_date` DATE NOT NULL ,
 `vehicle_type` VARCHAR(255) NOT NULL ,
 `vehicle_production_year` YEAR NOT NULL ,
 `fuel_type` VARCHAR(255) NOT NULL ,
 PRIMARY KEY (`id`));

ALTER TABLE `registrations` ADD UNIQUE(`reg_num`);

ALTER TABLE `registrations` ADD UNIQUE(`vehicle_chassis`);

# unique values for chassis num and reg num