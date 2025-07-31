INSERT INTO Cabin (cabinType, cabinDescription, pricePerNight, pricePerWeek, photo) VALUES
('Standard cabin sleeps 4', 'A 2 bedroom cabin with double in main and either double or 2 singles in the second bedroom', 100, 500, 'stCabin.jpg'),
('Standard open plan cabin sleeps 4', 'An open plan cabin with double bed and set of bunks', 120, 600, 'stOpenCabin.jpg'),
('Deluxe cabin sleeps 4', 'A 2 bedroom cabin with queen bed and 2 singles in the second bedroom', 140, 700, 'deluxCabin.jpg'),
('Villa sleeps 4', 'A 2 bedroom cabin with queen bed plus another bedroom with 2 single beds', 150, 750, 'villa.jpg'),
('Spa villa sleeps 4', 'A 2 bedroom cabin with queen bed plus another bedroom with 2 single beds and spa bath', 200, 1000, 'spaVilla.jpg'),
('Grass powered site', 'Powered sites on grass', 40, 200, 'grassPower.jpg'),
('Slab powered', 'Powered sites with slab', 50, 250, 'slabPower.jpg');


INSERT INTO Admin (userName, password, firstName, lastName, address, mobile) VALUES
('admin1', 'password1', 'John', 'Doe', '123 Street', '12345678'),
('admin2', 'password2', 'Jane', 'Smith', '456 Avenue', '87654321');


INSERT INTO Inclusion (incName, incDetails) VALUES
('1 bathroom', ''),
('1+ bathroom', '1 bathroom and separate toilet'),
('2 bathroom', ''),
('Air conditioner', 'Reverse cycle'),
('Ceiling fans', ''),
('Bunk bed', ''),
('2 single beds', ''),
('Double bed', ''),
('Dishwasher', ''),
('DVD Player', ''),
('Hair dryer', '');

INSERT INTO CabinInclusion (cabinID, incID) VALUES
(1, 1), (1, 6), (1, 8),
(2, 2), (2, 4), (2, 6), (2, 8), (2, 11),
(3, 3), (3, 8), (3, 10), (3, 11),
(4, 3), (4, 4), (4, 8), (4, 10), (4, 11),
(5, 3), (5, 4), (5, 7), (5, 8), (5, 9), (5, 10), (5, 11);


