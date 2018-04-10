/*

--
NAME:       PROSYS3 DATABASE GENERATOR
VERSION:    1.0
CREATED BY: PROSYS3
--

NOTE: This script will delete and recreate alle tables below.
Some of the affected tables will aslo be populated with preliminary data.

*/


-- ###########################################################################
-- DELETE ALL EXISTING TABLES
-- ###########################################################################

-- DROP ALL TABLES IF THEY EXIST:
SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS File;
DROP TABLE IF EXISTS File_Type;
DROP TABLE IF EXISTS Post;
DROP TABLE IF EXISTS Tags;
DROP TABLE IF EXISTS User_Data;
DROP TABLE IF EXISTS Company;
DROP TABLE IF EXISTS User_Type;
DROP TABLE IF EXISTS Categories;

SET FOREIGN_KEY_CHECKS=1;








-- ###########################################################################
-- CREATE ALL TABLES
-- ###########################################################################

-- USER TYPE:
CREATE TABLE User_Type (

    User_Type_ID 			        TINYINT(3) 		AUTO_INCREMENT NOT NULL,
    User_Type_Name                  VARCHAR(30) 	NOT NULL,
    Create_Post 			        TINYINT(1) 		NOT NULL,
    Create_File 			        TINYINT(1) 		NOT NULL,
    Create_User 			        TINYINT(1) 		NOT NULL,
    Create_User_Privileged          TINYINT(1)      NOT NULL,
    Read_Public_Post 		        TINYINT(1) 		NOT NULL,
    Read_Public_File 		        TINYINT(1) 		NOT NULL,
    Read_Public_User 		        TINYINT(1) 		NOT NULL,
    Update_Own_Post 		        TINYINT(1) 		NOT NULL,
    Update_Own_File 		        TINYINT(1) 		NOT NULL,
    Update_Others_Post 		        TINYINT(1) 		NOT NULL,
    Update_Others_File 		        TINYINT(1) 		NOT NULL,
    Update_Others_User              TINYINT(1)      NOT NULL,
    Update_Others_User_Privileged   TINYINT(1) 		NOT NULL,
    Delete_Own_Post 		        TINYINT(1) 		NOT NULL,
    Delete_Own_File 		        TINYINT(1) 		NOT NULL,
    Delete_Own_User 		        TINYINT(1) 		NOT NULL,
    Delete_Others_Post 		        TINYINT(1) 		NOT NULL,
    Delete_Others_File 		        TINYINT(1) 		NOT NULL,
    Delete_Others_User              TINYINT(1)      NOT NULL,
    Delete_Others_User_Privileged   TINYINT(1) 		NOT NULL,

    CONSTRAINT UserType_PK PRIMARY KEY (User_Type_ID)

) 	ENGINE = InnoDB DEFAULT CHARSET = utf8;




-- USER DATA:
CREATE TABLE Company (

    Company_ID              TINYINT(3)      AUTO_INCREMENT NOT NULL,
    Company_Name            VARCHAR(60)     NOT NULL,
    Company_Acronym         VARCHAR(60)     NOT NULL,
    Company_Country         VARCHAR(60)     NOT NULL,           
    Company_Website         VARCHAR(100)    NOT NULL,

    CONSTRAINT CompanyID_PK PRIMARY KEY (Company_ID)
    
)   ENGINE = InnoDB DEFAULT CHARSET = utf8;




-- USER DATA:
CREATE TABLE User_Data (

    User_ID 				TINYINT(3) 		AUTO_INCREMENT NOT NULL,
    User_Name_First			VARCHAR(60) 	NOT NULL,
    User_Name_Last			VARCHAR(60) 	NOT NULL,
    User_Email				VARCHAR(60) 	NOT NULL,
    User_Password			VARCHAR(100) 	NOT NULL,
    User_Type				TINYINT(3) 		NOT NULL,
    User_Phone				VARCHAR(8) 		NOT NULL,
    User_Company			TINYINT(2) 		NOT NULL,

    CONSTRAINT UserID_PK PRIMARY KEY (User_ID),
    CONSTRAINT User_Data_UserType_FK FOREIGN KEY (User_Type) REFERENCES User_Type(User_Type_ID),
    CONSTRAINT User_Data_UserCompany_FK FOREIGN KEY (User_Company) REFERENCES Company(Company_ID)
    
)	ENGINE = InnoDB DEFAULT CHARSET = utf8;




-- FILE TYPE:
CREATE TABLE File_Type (

	File_Type_ID			TINYINT(3) 		AUTO_INCREMENT NOT NULL,
	File_Type_Extension		VARCHAR(6) 		NOT NULL,
	File_Type_Name			VARCHAR(60) 	NOT NULL,

	CONSTRAINT FileType_PK PRIMARY KEY (File_Type_ID)

)	ENGINE= InnoDB DEFAULT CHARSET=utf8;




-- CATEGORIES:
CREATE TABLE Categories (

    Category_ID				TINYINT(3) 		AUTO_INCREMENT NOT NULL,
    Category_Name			VARCHAR(60) 	NOT NULL,
 
    CONSTRAINT CategoryID_PK PRIMARY KEY (Category_ID)
    
)	ENGINE = InnoDB DEFAULT CHARSET = utf8;




-- TAGS:
CREATE TABLE Tags (

	Tag_ID					TINYINT(3) 		NOT NULL,
	Tag_Name				VARCHAR(20) 	NOT NULL,

	CONSTRAINT TagID_PK PRIMARY KEY (Tag_ID)	

)	ENGINE = InnoDB DEFAULT CHARSET = utf8;




-- POST:
CREATE TABLE Post (

	Post_ID 				TINYINT(4) 		AUTO_INCREMENT NOT NULL, 
	Post_Title 				VARCHAR(60) 	NOT NULL,
	Post_Subtitle 			VARCHAR(100),
	Post_Image_Featured 	VARCHAR(100),
	Post_Text 				TEXT 			NOT NULL,
	Post_Date_Created 		DATE 			NOT NULL,
	Post_Date_Edited 		DATE 			NOT NULL,
	Post_Author 			TINYINT(3) 		NOT NULL,
	Post_Category 			TINYINT(3) 		DEFAULT 1,
	Post_Tag 				TINYINT(3) 		,
	Post_Private			TINYINT(1) 		DEFAULT 1,

	CONSTRAINT PostID_PK PRIMARY KEY(Post_ID),
	CONSTRAINT Post_UserID_FK FOREIGN KEY(Post_Author) REFERENCES User_Data(User_ID),
	CONSTRAINT Post_CategoryID_FK FOREIGN KEY(Post_Category) REFERENCES Categories(Category_ID),
	CONSTRAINT Post_TagID_FK FOREIGN KEY(Post_Tag) REFERENCES Tags(Tag_ID)

)	ENGINE = InnoDB DEFAULT CHARSET = utf8;




-- FILE:
CREATE TABLE File (

	File_ID				    TINYINT(4) 		AUTO_INCREMENT NOT NULL,
	File_Name			    VARCHAR(60) 	NOT NULL,
	File_Type			    TINYINT(3) 		NOT NULL,
	File_Author			    TINYINT(3) 		NOT NULL,
	File_Uploaded		    DATE 			NOT NULL,
    File_URL                VARCHAR(100)    NOT NULL,
	File_Category		    TINYINT(3) 		DEFAULT 1,
	File_Tags			    TINYINT(3) 		,
	File_Private		    TINYINT(1) 		DEFAULT 1,

	CONSTRAINT FileID_PK PRIMARY KEY (File_ID),
	CONSTRAINT File_FileTypeID_FK FOREIGN KEY (File_Type) REFERENCES File_Type(File_Type_ID),
	CONSTRAINT File_CategoryID_FK FOREIGN KEY (File_Category) REFERENCES Categories(Category_ID),
	CONSTRAINT File_TagID_FK FOREIGN KEY (File_Tags) REFERENCES Tags(Tag_ID),
    CONSTRAINT File_UserID_FK FOREIGN KEY (File_Author) REFERENCES User_Data(User_ID)

)	ENGINE = InnoDB DEFAULT CHARSET = utf8;








-- ###########################################################################
-- POPULATING NECESSARY TABLES
-- ###########################################################################

-- CREATE DEFAULT CATEGORY:
INSERT INTO Categories (Category_Name)
VALUES ("Uncategorized");




-- CREATE TEST TAG:
INSERT INTO Tags (Tag_Name)
VALUES ("USN");




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
(   "User",             1, 1, 0, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 0 );




-- CREATE FILE TYPES:
INSERT INTO File_Type ( File_Type_Extension, File_Type_Name ) VALUES
('.aac',    'AAC audio file'),
('.abw',    'AbiWord document'),
('.arc',    'Archive document (multiple files embedded)'),
('.avi',    'AVI: Audio Video Interleave'),
('.azw',    'Amazon Kindle eBook format'),
('.bin',    'Any kind of binary data'),
('.bz',     'BZip archive'),
('.bz2',    'BZip2 archive'),
('.csh',    'C-Shell script'),
('.css',    'Cascading Style Sheets (CSS)'),
('.csv',    'Comma-separated values (CSV)'),
('.doc',    'Microsoft Word'),
('.docx',   'Microsoft Word (OpenXML)'),
('.eot',    'MS Embedded OpenType fonts'),
('.epub',   'Electronic publication (EPUB)'),
('.gif',    'Graphics Interchange Format (GIF)'),
('.htm',    'HyperText Markup Language (HTML)'),
('.html',   'HyperText Markup Language (HTML)'),
('.ico',    'Icon format'),
('.ics',    'iCalendar format'),
('.jar',    'Java Archive (JAR)'),
('.jpeg',   'JPEG images'),
('.jpg',    'JPEG images'),
('.js',     'JavaScript (ECMAScript)'),
('.json',   'JSON format'),
('.mid',    'Musical Instrument Digital Interface (MIDI)'),
('.midi',   'Musical Instrument Digital Interface (MIDI)'),
('.mpeg',   'MPEG Video'),
('.mpkg',   'Apple Installer Package'),
('.odp',    'OpenDocument presentation document'),
('.ods',    'OpenDocument spreadsheet document'),
('.odt',    'OpenDocument text document'),
('.oga',    'OGG audio'),
('.ogv',    'OGG video'),
('.ogx',    'OGG'),
('.otf',    'OpenType font'),
('.png',    'Portable Network Graphics'),
('.pdf',    'Adobe Portable Document Format (PDF)'),
('.ppt',    'Microsoft PowerPoint'),
('.pptx',   'Microsoft PowerPoint (OpenXML)'),
('.rar',    'RAR archive'),
('.rtf',    'Rich Text Format (RTF)'),
('.sh',     'Bourne shell script'),
('.svg',    'Scalable Vector Graphics (SVG)'),
('.swf',    'Small web format (SWF) or Adobe Flash document'),
('.tar',    'Tape Archive (TAR)'),
('.tif',    'Tagged Image File Format (TIFF)'),
('.tiff',   'Tagged Image File Format (TIFF)'),
('.ts',     'Typescript file'),
('.ttf',    'TrueType Font'),
('.vsd',    'Microsoft Visio'),
('.wav',    'Waveform Audio Format'),
('.weba',   'WEBM audio'),
('.webm',   'WEBM video'),
('.webp',   'WEBP image'),
('.woff',   'Web Open Font Format (WOFF)'),
('.woff2',  'Web Open Font Format (WOFF)'),
('.xhtml',  'XHTML'),
('.xls',    'Microsoft Excel'),
('.xlsx',   'Microsoft Excel (OpenXML)'),
('.xml',    'XML'),
('.xul',    'XUL'),
('.zip',    'ZIP archive'),
('.3gp',    '3GPP audio/video container'),
('.3g2',    '3GPP2 audio/video container'),
('.7z',     '7-zip archive');



