CREATE TABLE IF NOT EXISTS Client (
    ClientID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100),
    Email VARCHAR(100) UNIQUE,
    Password VARCHAR(100),
    Wishes VARCHAR(500),
    IsAdmin BOOLEAN,
    IsActive BOOLEAN,
    IsBlocked BOOLEAN
);

CREATE TABLE IF NOT EXISTS Movie (
    MovieID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(150),
    Year INT,
    Genre VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS Platform (
    PlatformID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100),
    Website VARCHAR(200)
);

CREATE TABLE IF NOT EXISTS Rent (
    RentID INT AUTO_INCREMENT PRIMARY KEY,
    MovieID INT,
    PlatformID INT,
    Price DECIMAL(10, 2),
    Currency VARCHAR(3),
    UploadDate DATE,
    FOREIGN KEY (MovieID) REFERENCES Movie(MovieID),
    FOREIGN KEY (PlatformID) REFERENCES Platform(PlatformID)
);

CREATE TABLE IF NOT EXISTS RentHistory (
    RentHistoryID INT AUTO_INCREMENT PRIMARY KEY,
    ClientID INT,
    MovieID INT,
    RentDate DATE,
    PlatformID INT,
    RentPrice DECIMAL(10, 2),
    FOREIGN KEY (ClientID) REFERENCES Client(ClientID),
    FOREIGN KEY (MovieID) REFERENCES Movie(MovieID),
    FOREIGN KEY (PlatformID) REFERENCES Platform(PlatformID)
);

CREATE TABLE IF NOT EXISTS Discount (
    DiscountID INT AUTO_INCREMENT PRIMARY KEY,
    PlatformID INT,
    Description VARCHAR(500),
    DiscountAmount DECIMAL(5, 2),
    BeginDate DATE,
    EndDate DATE,
    FOREIGN KEY (PlatformID) REFERENCES Platform(PlatformID)
);

CREATE TABLE IF NOT EXISTS Recommendation (
    RecommendationID INT AUTO_INCREMENT PRIMARY KEY,
    ClientID INT,
    MovieID INT,
    RecommendationDate DATE,
    FOREIGN KEY (ClientID) REFERENCES Client(ClientID),
    FOREIGN KEY (MovieID) REFERENCES Movie(MovieID)
);

CREATE TABLE IF NOT EXISTS SalesReport (
    ReportID INT AUTO_INCREMENT PRIMARY KEY,
    BeginDate DATE,
    EndDate DATE,
    Amount DECIMAL(15, 2),
    RentCount INT
);
