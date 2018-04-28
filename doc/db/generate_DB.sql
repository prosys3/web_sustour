/*

--
NAME:       PROSYS3 DATABASE GENERATOR
VERSION:    3.0
CREATED BY: PROSYS3
--

NOTE: This script will delete and recreate alle tables below.
Some of the affected tables will aslo be populated with preliminary data.

*/


-- ###########################################################################
-- CREATE DEFAULT DATABASE
-- ###########################################################################

-- DROP DATABASE IF IT EXISTS:
DROP DATABASE IF EXISTS prosys3;




-- CREATE DATABASE:
CREATE DATABASE prosys3 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;








-- ###########################################################################
-- DELETE ALL EXISTING TABLES
-- ###########################################################################

-- DROP ALL TABLES IF THEY EXIST:
SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS File;
DROP TABLE IF EXISTS File_Type;
DROP TABLE IF EXISTS Post;
DROP TABLE IF EXISTS User_Data;
DROP TABLE IF EXISTS Event;
DROP TABLE IF EXISTS Activities;
DROP TABLE IF EXISTS Company;
DROP TABLE IF EXISTS User_Type;
DROP TABLE IF EXISTS Category;

SET FOREIGN_KEY_CHECKS=1;








-- ###########################################################################
-- CREATE ALL TABLES
-- ###########################################################################

-- USER TYPE:
CREATE TABLE User_Type (

    User_Type_ID                          TINYINT(3)        AUTO_INCREMENT NOT NULL,
    User_Type_Name                  VARCHAR(30)     NOT NULL,
    Create_Post                           TINYINT(1)        NOT NULL,
    Create_File                           TINYINT(1)        NOT NULL,
    Create_User                           TINYINT(1)        NOT NULL,
    Create_User_Privileged          TINYINT(1)    NOT NULL,
    Read_Public_Post                    TINYINT(1)      NOT NULL,
    Read_Public_File                    TINYINT(1)      NOT NULL,
    Read_Public_User                    TINYINT(1)      NOT NULL,
    Update_Own_Post                     TINYINT(1)      NOT NULL,
    Update_Own_File                     TINYINT(1)      NOT NULL,
    Update_Others_Post                TINYINT(1)        NOT NULL,
    Update_Others_File                TINYINT(1)        NOT NULL,
    Update_Others_User              TINYINT(1)    NOT NULL,
    Update_Others_User_Privileged   TINYINT(1)      NOT NULL,
    Delete_Own_Post                     TINYINT(1)      NOT NULL,
    Delete_Own_File                     TINYINT(1)      NOT NULL,
    Delete_Own_User                     TINYINT(1)      NOT NULL,
    Delete_Others_Post                TINYINT(1)        NOT NULL,
    Delete_Others_File                TINYINT(1)        NOT NULL,
    Delete_Others_User              TINYINT(1)    NOT NULL,
    Delete_Others_User_Privileged   TINYINT(1)      NOT NULL,

    CONSTRAINT UserType_PK PRIMARY KEY (User_Type_ID)

)   ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE utf8mb4_unicode_ci;




-- USER DATA:
CREATE TABLE Company (

    Company_ID          TINYINT(3)      AUTO_INCREMENT NOT NULL,
    Company_Name        VARCHAR(60)     NOT NULL,
    Company_Acronym     VARCHAR(60)     NOT NULL,
    Company_Country     VARCHAR(60)     NOT NULL,
    Company_Website     VARCHAR(100)    NOT NULL,

    CONSTRAINT CompanyID_PK PRIMARY KEY (Company_ID)

)   ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE utf8mb4_unicode_ci;




-- USER DATA:
CREATE TABLE User_Data (

    User_ID                     TINYINT(3)      AUTO_INCREMENT NOT NULL,
    User_Name_First         VARCHAR(60)     NOT NULL,
    User_Name_Last          VARCHAR(60)     NOT NULL,
    User_Password             VARCHAR(100)  NOT NULL,
    User_Type                   TINYINT(3)      NOT NULL,
    User_Email                VARCHAR(60)   UNIQUE NOT NULL,
    User_Phone                VARCHAR(8)        NOT NULL,
    User_Company              TINYINT(2)        NOT NULL,

    CONSTRAINT UserID_PK PRIMARY KEY (User_ID),
    CONSTRAINT User_Data_UserType_FK FOREIGN KEY (User_Type) REFERENCES User_Type(User_Type_ID),
    CONSTRAINT User_Data_UserCompany_FK FOREIGN KEY (User_Company) REFERENCES Company(Company_ID)

)   ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE utf8mb4_unicode_ci;




-- EVENT
CREATE TABLE Event (

Event_ID        TINYINT(3)          AUTO_INCREMENT NOT NULL,
Event_Name      VARCHAR(40)         NOT NULL,
Event_Location  VARCHAR(50)         NOT NULL,
Event_Start     Time                NOT NULL,
Event_End       Time                NOT NULL,
Event_Date      DATE                NOT NULL,
Event_Text      VARCHAR(255)        NOT NULL,
Event_Company   TINYINT(3)          NOT NULL,
Event_Author    TINYINT(3)          NOT NULL,

CONSTRAINT EventID_PK               PRIMARY KEY (Event_ID),
CONSTRAINT Event_EventCompany_FK    FOREIGN KEY (Event_Company) REFERENCES Company(Company_ID),
CONSTRAINT Event_EventAuthor_FK     FOREIGN KEY (Event_Author) REFERENCES User_Data(User_ID)

) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE utf8mb4_unicode_ci;




-- FILE TYPE:
CREATE TABLE File_Type (

    File_Type_ID                TINYINT(3)      AUTO_INCREMENT NOT NULL,
    File_Type_Extension     VARCHAR(6)      NOT NULL,
    File_Type_Name            VARCHAR(60)   NOT NULL,

    CONSTRAINT FileType_PK PRIMARY KEY (File_Type_ID)

)   ENGINE= InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;




-- CATEGORIES:
CREATE TABLE Category (

    Category_ID               TINYINT(3)        AUTO_INCREMENT NOT NULL,
    Category_Name             VARCHAR(60)   NOT NULL,

    CONSTRAINT CategoryID_PK PRIMARY KEY (Category_ID)

)   ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE utf8mb4_unicode_ci;




-- POST:
CREATE TABLE Post (

    Post_ID                     TINYINT(4)      AUTO_INCREMENT NOT NULL,
    Post_Title                  VARCHAR(60)     NOT NULL,
    Post_Image_Featured         VARCHAR(100),
    Post_Text                   TEXT                NOT NULL,
    Post_Date_Created           DATE                NOT NULL,
    Post_Author                 TINYINT(3)      NOT NULL,
    Post_Category               TINYINT(3)      DEFAULT 1,
    Post_Private                TINYINT(1)      DEFAULT 1,

    CONSTRAINT PostID_PK PRIMARY KEY(Post_ID),
    CONSTRAINT Post_UserID_FK FOREIGN KEY(Post_Author) REFERENCES User_Data(User_ID),
    CONSTRAINT Post_CategoryID_FK FOREIGN KEY(Post_Category) REFERENCES Category(Category_ID)

)   ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE utf8mb4_unicode_ci;



-- ACTIVITIES

CREATE TABLE Activities (

Activities_ID           TINYINT(4)      AUTO_INCREMENT NOT NULL,
Activities_Title        VARCHAR(50)     NOT NULL,
Activities_Text         TEXT            NOT NULL,
Activities_Created      DATE            NOT NULL,
Activities_Author   TINYINT(3) NOT NULL,

CONSTRAINT ActivitiesID_PK PRIMARY KEY (Activities_ID),
CONSTRAINT Activities_UserID_FK FOREIGN KEY (Activities_Author) REFERENCES User_Data(User_ID)




) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE utf8mb4_unicode_ci;




-- FILE:
CREATE TABLE File (

    File_ID                     TINYINT(4)      AUTO_INCREMENT NOT NULL,
    File_Name                   VARCHAR(60)     NOT NULL,
    File_Type                   TINYINT(3)      NOT NULL,
  File_Size             INT           NOT NULL,
    File_Author               TINYINT(3)        NOT NULL,
    File_Uploaded             DATE              NOT NULL,
  File_URL              VARCHAR(100)  NOT NULL,
    File_Category             TINYINT(3)        DEFAULT 1,
    File_Private              TINYINT(1)        DEFAULT 1,

    CONSTRAINT FileID_PK PRIMARY KEY (File_ID),
    CONSTRAINT File_FileTypeID_FK FOREIGN KEY (File_Type) REFERENCES File_Type(File_Type_ID),
    CONSTRAINT File_CategoryID_FK FOREIGN KEY (File_Category) REFERENCES Category(Category_ID),
  CONSTRAINT File_UserID_FK FOREIGN KEY (File_Author) REFERENCES User_Data(User_ID)

)   ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE utf8mb4_unicode_ci;








-- ###########################################################################
-- POPULATING NECESSARY TABLES
-- ###########################################################################

-- CREATE DEFAULT CATEGORY:
INSERT INTO Category (Category_Name) VALUES
  ("Uncategorized"),
  ("Project report"),
  ("Financial");




-- CREATE STANDARD USER TYPES:
INSERT INTO User_Type
(   User_Type_Name,

    Create_Post,
    Create_File,
    Create_User,
    Create_User_Privileged,
    Read_Public_Post,
    Read_Public_File,
    Read_Public_User,
    Update_Own_Post,
    Update_Own_File,
    Update_Others_Post,
    Update_Others_File,
    Update_Others_User,
    Update_Others_User_Privileged,
    Delete_Own_Post,
    Delete_Own_File,
    Delete_Own_User,
    Delete_Others_Post,
    Delete_Others_File,
    Delete_Others_User,
    Delete_Others_User_Privileged
)
VALUES
(   "Root",             1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1 ),
(   "Administrator",    1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0 ),
(   "Moderator",        1, 1, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 0 ),
(   "User",             1, 1, 0, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 0 ),
(   "None",             0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 );




-- CREATE FILE TYPES:
INSERT INTO File_Type ( File_Type_Extension, File_Type_Name ) VALUES
('aac',    'AAC audio file'),
('abw',    'AbiWord document'),
('arc',    'Archive document (multiple files embedded)'),
('avi',    'AVI: Audio Video Interleave'),
('azw',    'Amazon Kindle eBook format'),
('bin',    'Any kind of binary data'),
('bz',     'BZip archive'),
('bz2',    'BZip2 archive'),
('csh',    'C-Shell script'),
('css',    'Cascading Style Sheets (CSS)'),
('csv',    'Comma-separated values (CSV)'),
('doc',    'Microsoft Word'),
('docx',   'Microsoft Word (OpenXML)'),
('eot',    'MS Embedded OpenType fonts'),
('epub',   'Electronic publication (EPUB)'),
('gif',    'Graphics Interchange Format (GIF)'),
('htm',    'HyperText Markup Language (HTML)'),
('html',   'HyperText Markup Language (HTML)'),
('ico',    'Icon format'),
('ics',    'iCalendar format'),
('jar',    'Java Archive (JAR)'),
('jpeg',   'JPEG images'),
('jpg',    'JPEG images'),
('js',     'JavaScript (ECMAScript)'),
('json',   'JSON format'),
('mid',    'Musical Instrument Digital Interface (MIDI)'),
('midi',   'Musical Instrument Digital Interface (MIDI)'),
('mpeg',   'MPEG Video'),
('mpkg',   'Apple Installer Package'),
('odp',    'OpenDocument presentation document'),
('ods',    'OpenDocument spreadsheet document'),
('odt',    'OpenDocument text document'),
('oga',    'OGG audio'),
('ogv',    'OGG video'),
('ogx',    'OGG'),
('otf',    'OpenType font'),
('png',    'Portable Network Graphics'),
('pdf',    'Adobe Portable Document Format (PDF)'),
('ppt',    'Microsoft PowerPoint'),
('pptx',   'Microsoft PowerPoint (OpenXML)'),
('rar',    'RAR archive'),
('rtf',    'Rich Text Format (RTF)'),
('sh',     'Bourne shell script'),
('svg',    'Scalable Vector Graphics (SVG)'),
('swf',    'Small web format (SWF) or Adobe Flash document'),
('tar',    'Tape Archive (TAR)'),
('tif',    'Tagged Image File Format (TIFF)'),
('tiff',   'Tagged Image File Format (TIFF)'),
('ts',     'Typescript file'),
('ttf',    'TrueType Font'),
('vsd',    'Microsoft Visio'),
('wav',    'Waveform Audio Format'),
('weba',   'WEBM audio'),
('webm',   'WEBM video'),
('webp',   'WEBP image'),
('woff',   'Web Open Font Format (WOFF)'),
('woff2',  'Web Open Font Format (WOFF)'),
('xhtml',  'XHTML'),
('xls',    'Microsoft Excel'),
('xlsx',   'Microsoft Excel (OpenXML)'),
('xml',    'XML'),
('xul',    'XUL'),
('zip',    'ZIP archive'),
('3gp',    '3GPP audio/video container'),
('3g2',    '3GPP2 audio/video container'),
('7z',     '7-zip archive');




-- INSERT DEFAULT COMPANIES:
INSERT INTO Company (Company_Name, Company_Acronym, Company_Country, Company_Website) VALUES
('N/A', 'N/A', 'N/A', 'N/A'),
('University College of Southeast Norway', 		'USN',  'Norway', 	  'https://usn.no'),
('Bishkek Academy of Finance and Economics', 	'ADAM', 'Kyrgyzstan', 'https://bafe.edu.kg'),
('Issyk Kul State University', 					'IKSU', 'Kyrgyzstan', 'http://www.iksu.kg/'),
('Kyrgyz Economic University', 					'KEU',  'Kyrgyzstan', 'http://www.keu.kg/'),
('Batumi Shota Rustaveli State University', 	'BSU',  'Georgia', 	  'https://www.bsu.edu.ge'),
('Akaki Tsereteli State University', 			'ATSU', 'Georgia',    'http://www.atsu.edu.ge/index.php?lang=en'),
('Batumi State Maritime Academy', 				'BSMA', 'Georgia', 	  'http://www.bsma.edu.ge/index.html?lang=en');



-- INSERT DEFAULT USERS:
INSERT INTO User_Data (User_Name_First, User_Name_Last, User_Password, User_Type, User_Email, User_Phone, User_Company) VALUES
('Deleted', 'User',     MD5('prosys3'), 5, 'N/A',           'N/A',      1),
('Lord', 'Root',        MD5('prosys3'), 1, 'root@usn.no',   '10000666', 2),
('Sustainable', 'Tourism', 	MD5('sustour'), 1, 	'Sustainable@Tourism.no',	'20000666',  1),
('Prince', 'Admin',     MD5('prosys3'), 2, 'admin@usn.no',  '30000666', 3),
('Sir', 'Moderator',    MD5('prosys3'), 3, 'mod@usn.no',    '40000666', 4),
('Peasant', 'User',     MD5('prosys3'), 4, 'user@usn.no',   '50000666', 7);





-- INSERT DEFAULT POSTS:
INSERT INTO Post (Post_Title, Post_Image_Featured, Post_Text, Post_Date_Created, Post_Author, Post_Category, Post_Private) VALUES
('Example post 1', 'http://ibmathsworld.com/wp-content/uploads/2016/01/IB-Examples.jpg', '<h1>Main title</h1><h2>Subtitle</h2><p>This is an example paragraph</p>', CURDATE(),          2, 1, 1),
('Example post 2', 'http://ibmathsworld.com/wp-content/uploads/2016/01/IB-Examples.jpg', '<h1>Main title</h1><h2>Subtitle</h2><p>This is an example paragraph</p>', (CURDATE() + 1),    2, 1, 1),
('Example post 3', 'http://ibmathsworld.com/wp-content/uploads/2016/01/IB-Examples.jpg', '<h1>Main title</h1><h2>Subtitle</h2><p>This is an example paragraph</p>', (CURDATE() + 2),    4, 1, 0),
('Example post 4', 'http://ibmathsworld.com/wp-content/uploads/2016/01/IB-Examples.jpg', '<h1>Main title</h1><h2>Subtitle</h2><p>This is an example paragraph</p>', (CURDATE() + 3),    5, 1, 0),
('Example post 5', 'http://ibmathsworld.com/wp-content/uploads/2016/01/IB-Examples.jpg', '<h1>Main title</h1><h2>Subtitle</h2><p>This is an example paragraph</p>', (CURDATE() + 4),    5, 1, 0);
                                                 





-- INSERT DEFAULT POSTS:
INSERT INTO Activities (Activities_Title, Activities_Text, Activities_Created, Activities_Author) VALUES
('Student mobilities between all three countries', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', CURDATE(), 2 ),
('Staff mobilites between all three countries', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', CURDATE() + 1, 2),
('Summer school in Norway 2016', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', CURDATE() + 2, 2),
('Summer schhol in Kyrgyzstan 2017', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', CURDATE(), 2),
('Summer school in Georgia 2018', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', CURDATE() + 2, 2),
('Course development', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', CURDATE(), 2);

-- INSERT DEFAULT EVENTS
INSERT INTO event(Event_ID, Event_Name, Event_Location, Event_Start, Event_End, Event_Date, Event_Company, Event_Author, Event_Text) VALUES
(1, 'Opening party', 'B&oslash', '20:00' , '24:00' , '2018-08-04', 2, 2, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>'),
(2, 'Meeting for summer school attendees', 'Blue city', '17:00' , '18:00' , '2018-07-07', 7, 2, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit </br> Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>'),
(3, 'Open school ', 'B&oslash', '18:00' , '21:00' , '2018-08-20', 2, 5, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit </br> Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>'),
(4, 'Meeting for summer school attendees', 'B&oslash', '17:00' , '18:00' , '2018-07-07', 2, 4, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit </br> Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>'),
(5, 'Meeting for summer school attendees', 'Greentown', '17:00' , '18:00' , '2018-07-07', 6, 4, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit </br> Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>'),
(6, 'Curry bonanza', 'Green road', '15:00' , '17:00' , '2018-08-08', 4, 4, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>'),
(7, 'Opening party', 'B&oslash', '20:00' , '24:00' , '2018-01-04', 2, 2, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>'),
(8, 'Meeting for summer school attendees', 'B&oslash', '17:00' , '18:00' , '2018-02-07', 2, 4, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit </br> Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>'),
(9, 'Open school ', 'Whole school', '18:00' , '21:00' , '2018-01-20', 5, 2, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit </br> Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>'),
(10, 'Meeting for summer school attendees', 'B&oslash', '17:00' , '18:00' , '2018-02-07', 2, 4, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit </br> Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>'),
(11, 'Meeting for summer school attendees', 'Greentown', '17:00' , '18:00' , '2018-02-07', 6, 2, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit </br> Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>'),
(12, 'Curry bonanza', 'Green road', '15:00' , '17:00' , '2018-01-08', 4, 2, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>');