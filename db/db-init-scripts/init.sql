CREATE TABLE IF NOT EXISTS User (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100),
    Username VARCHAR(100) UNIQUE,
    Email VARCHAR(100) UNIQUE,
    Password VARCHAR(100),
    IsAdmin BOOLEAN,
    IsActive BOOLEAN,
    IsBlocked BOOLEAN
);
CREATE TABLE IF NOT EXISTS Friendship (
    UserID INT,
    FriendID INT,
    FOREIGN KEY (UserID) REFERENCES User(UserID),
    FOREIGN KEY (FriendID) REFERENCES User(UserID)
);
CREATE TABLE IF NOT EXISTS FriendshipRequests (
    ToUser INT,
    FromUser INT,
    IsAccepted BOOLEAN,
    FOREIGN KEY (ToUser) REFERENCES User(UserID),
    FOREIGN KEY (FromUser) REFERENCES User(UserID)
);
CREATE TABLE IF NOT EXISTS ProfilePictures (
    ImageID INT AUTO_INCREMENT PRIMARY KEY,
    ProfileImage BLOB,
    MimeType VARCHAR(30)
);
CREATE TABLE IF NOT EXISTS UsersImages (
    UserID INT,
    ImageID INT,
    FOREIGN KEY (UserID) REFERENCES User(UserID),
    FOREIGN KEY (ImageID) REFERENCES ProfilePictures(ImageID)
)