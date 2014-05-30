CREATE SCHEMA IF NOT EXISTS UPTM DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

USE `UPTM`;

CREATE TABLE IF NOT EXISTS Country (
	Id INT PRIMARY KEY AUTO_INCREMENT,
	Name VARCHAR(50) NOT NULL
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS State (
	Id INT PRIMARY KEY AUTO_INCREMENT,
	Name VARCHAR(50) NOT NULL,
	Country_Id INT NOT NULL,
	INDEX fk_state_country (Country_Id ASC),
	CONSTRAINT fk_state_country
	FOREIGN KEY (Country_Id) REFERENCES Country(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS City (
	Id INT PRIMARY KEY AUTO_INCREMENT,
	Name VARCHAR(50) NOT NULL,
	State_Id INT NOT NULL,
	INDEX fk_city_state (State_Id ASC),
	CONSTRAINT fk_city_state
	FOREIGN KEY (State_Id) REFERENCES State(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS Participant (
	Id INT PRIMARY KEY AUTO_INCREMENT,
	DNI VARCHAR(13) NOT NULL UNIQUE,
	Name VARCHAR(50) NOT NULL,
	Last_Name VARCHAR(50) NOT NULL,
	Email VARCHAR(100) NOT NULL,
	Gender ENUM('Male','Female') NOT NULL,
	Username VARCHAR(15) NOT NULL,
	Password VARCHAR(40) NOT NULL,
	Register_Date DATE NOT NULL,
	City_Id INT NOT NULL,
	INDEX fk_participant_city (City_Id ASC),
	CONSTRAINT fk_participant_city
	FOREIGN KEY (City_Id) REFERENCES City(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS User (
	Id INT PRIMARY KEY AUTO_INCREMENT,
	Type ENUM('Super Admin','Admin','Evaluation Committee') NOT NULL,
	Participant_Id INT NOT NULL,
	INDEX fk_user_participant (Participant_Id ASC),
	CONSTRAINT fk_user_participant
	FOREIGN KEY (Participant_Id) REFERENCES Participant(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


CREATE TABLE IF NOT EXISTS Event (
	Id INT PRIMARY KEY AUTO_INCREMENT,
	Name VARCHAR(200) NOT NULL,
	Purpose TEXT,
	/*Course = Curso, Seminary = Seminario, Diplomaed = Seminario, Meeting = Encuentros, Practical Course = Taller, Conference = Jornadas, Conversational = Conversatorio, Speech = Ponencia */
	Type ENUM('Course','Seminary','Diplomaed','Congress Conversational','Meeting Conversational', 'Practical Course', 'Conference Conversational','Congress Cartel','Conference Cartel','Meeting Cartel','Congress Speech','Conference Speech',' Meeting Speech') NOT NULL
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS Scheduled_Event (
	Id INT PRIMARY KEY AUTO_INCREMENT,
	Start_Date DATE NOT NULL,
	End_Date DATE NOT NULL,
	Mode ENUM('Online','Classroom') NOT NULL,
	Quota INT NULL,
	Status ENUM('Active','Off') NOT NULL,
	Slogan TEXT NULL,
	Hours INT NULL,
	Extending_summary_date DATE NULL,
	Extending_final_report_date DATE NULL,
	Event_Id INT NOT NULL,
	INDEX fk_scheduled_event_event (Event_Id ASC),
	CONSTRAINT fk_scheduled_event_event
	FOREIGN KEY (Event_Id) REFERENCES Event(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS Sale (
	Id INT PRIMARY KEY AUTO_INCREMENT,
	Start_Date DATE NOT NULL,
	End_Date DATE NOT NULL,
	Description VARCHAR(100),
	Status ENUM('Active','Off') NOT NULL,
	Type ENUM('Participant','Speaker','Validation') NOT NULL,
	Scheduled_Event_Id INT NOT NULL,
	INDEX fk_sale_scheduled_event (Scheduled_Event_Id ASC),
	CONSTRAINT fk_sale_scheduled_event
	FOREIGN KEY (Scheduled_Event_Id) REFERENCES Scheduled_Event(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS Cost (
	Id INT PRIMARY KEY AUTO_INCREMENT,
	Amount DOUBLE NOT NULL,
	Type ENUM('Student','Speaker','Professionals & General Public') NOT NULL,
	Sale_Id INT NOT NULL,
	INDEX fk_cost_sale (Sale_Id ASC),
	CONSTRAINT fk_cost_sale
	FOREIGN KEY (Sale_Id) REFERENCES Sale(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS Registration (
	Id INT PRIMARY KEY AUTO_INCREMENT,
	Status ENUM('Paid','Cancel','Free','Without Payment','Exempt','Collaborator','Organizer') NOT NULL,
	Registration_Date DATE NOT NULL,
	Sale_Id INT NOT NULL,
	Participant_Id INT NOT NULL,
	Scheduled_Event_Id INT NOT NULL,
	INDEX fk_registration_sale (Sale_Id ASC),
	CONSTRAINT fk_registration_sale
	FOREIGN KEY (Sale_Id) REFERENCES Sale(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
	INDEX fk_registration_participant (Participant_Id ASC),
	CONSTRAINT fk_registration_participant
	FOREIGN KEY (Participant_Id) REFERENCES Participant(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
	INDEX fk_registration_scheduled_event (Scheduled_Event_Id ASC),
	CONSTRAINT fk_registration_scheduled_event
	FOREIGN KEY (Scheduled_Event_Id) REFERENCES Scheduled_Event(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS Certified_Design (
	Id INT PRIMARY KEY AUTO_INCREMENT,
	Img VARCHAR(25) NOT NULL,
	Scheduled_Event_Id INT NOT NULL,
	INDEX fk_certified_design_scheduled_event (Scheduled_Event_Id ASC),
	CONSTRAINT fk_certified_design_scheduled_event
	FOREIGN KEY (Scheduled_Event_Id) REFERENCES Scheduled_Event(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS Content (
	Id INT PRIMARY KEY AUTO_INCREMENT,
	X DOUBLE NOT NULL,
	Y DOUBLE NOT NULL,
	WH DOUBLE NOT NULL,
	Name ENUM('Full Name','Name','Last_Name','DNI','Hours','Event_Type','Event_Name','Mode') NOT NULL,
	Certified_Design_Id INT NOT NULL,
	INDEX fk_content_certified_design (Certified_Design_Id ASC),
	CONSTRAINT fk_content_certified_design
	FOREIGN KEY (Certified_Design_Id) REFERENCES Certified_Design(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS Knowledge (
	Id INT PRIMARY KEY AUTO_INCREMENT,
	`Order` INT NOT NULL,
	Content TEXT NOT NULL,
	Scheduled_Event_Id INT NOT NULL,
	INDEX fk_knowledge_scheduled_event (Scheduled_Event_Id ASC),
	CONSTRAINT fk_knowledge_scheduled_event
	FOREIGN KEY (Scheduled_Event_Id) REFERENCES Scheduled_Event(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS Place (
	Id INT PRIMARY KEY AUTO_INCREMENT,
	Name VARCHAR(100) NOT NULL,
	Description TEXT,
	Scheduled_Event_Id INT NOT NULL,
	INDEX fk_place_scheduled_event (Scheduled_Event_Id ASC),
	CONSTRAINT fk_place_scheduled_event
	FOREIGN KEY (Scheduled_Event_Id) REFERENCES Scheduled_Event(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS Planning (
	Id INT PRIMARY KEY AUTO_INCREMENT,
	Start_Date DATE NOT NULL,
	End_Date DATE NOT NULL,
	Description TEXT,
	Scheduled_Event_Id INT NOT NULL,
	INDEX fk_planning_scheduled_event (Scheduled_Event_Id ASC),
	CONSTRAINT fk_planning_scheduled_event
	FOREIGN KEY (Scheduled_Event_Id) REFERENCES Scheduled_Event(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS Activity (
	Id INT PRIMARY KEY AUTO_INCREMENT,
	Title VARCHAR(250) NOT NULL,
	/*Course = Curso, Seminary = Seminario, Diplomaed = Seminario, Meeting = Encuentros, Practical Course = Taller, Conference = Jornadas, Conversational = Conversatorio, Oral Speech = Ponencia Oral */
	Mode ENUM('Oral Speech','Practical Course','Seminary','Cartel','Conference','Conversational') NOT NULL,
	Participation_Type ENUM('Online','Classroom') NOT NULL,
	Keywords VARCHAR(150),
	Summary VARCHAR(50),
	Summary_Words TEXT,
	Scheduled_Event_Id INT NOT NULL,
	INDEX fk_activity_scheduled_event (Scheduled_Event_Id ASC),
	CONSTRAINT fk_activity_scheduled_event
	FOREIGN KEY (Scheduled_Event_Id) REFERENCES Scheduled_Event(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS Author (
	Id INT PRIMARY KEY AUTO_INCREMENT,
	Type ENUM('Primary','Secondary') NOT NULL,
	Institution VARCHAR(100) NOT NULL,
	Activity_Id INT NOT NULL,
	Participant_Id INT NOT NULL,
	INDEX fk_author_activity (Activity_Id ASC),
	CONSTRAINT fk_author_activity
	FOREIGN KEY (Activity_Id) REFERENCES Activity(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
	INDEX fk_author_participant (Participant_Id ASC),
	CONSTRAINT fk_author_participant
	FOREIGN KEY (Participant_Id) REFERENCES Participant(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS Account (
	Id INT PRIMARY KEY AUTO_INCREMENT,
	Bank VARCHAR(30) NOT NULL,
	Number VARCHAR(20) NOT NULL,
	Holder VARCHAR(75) NOT NULL,
	DNI VARCHAR(15) NOT NULL,
	Status ENUM('Active','Off') NOT NULL,
	Type ENUM('Savings Account','Checking Account') NOT NULL
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS Scheduled_Event_Account (
	Id INT PRIMARY KEY AUTO_INCREMENT,
	Scheduled_Event_Id INT NOT NULL,
	Account_Id INT NOT NULL,
	INDEX fk_scheduled_event_account_scheduled_event (Scheduled_Event_Id ASC),
	CONSTRAINT fk_scheduled_event_account_scheduled_event
	FOREIGN KEY (Scheduled_Event_Id) REFERENCES Scheduled_Event(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
	INDEX fk_scheduled_event_account_account (Account_Id ASC),
	CONSTRAINT fk_scheduled_event_account_account
	FOREIGN KEY (Account_Id) REFERENCES Account(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS Payment (
	Id INT PRIMARY KEY AUTO_INCREMENT,
	Payment_Date DATE NOT NULL,
	Amount DOUBLE NOT NULL,
	Voucher_Number VARCHAR(30) NOT NULL,
	Register_Date DATE NOT NULL,
	Status ENUM('Validated','No Validated') NOT NULL,
	Registration_Id INT NOT NULL,
	Account_Id INT NOT NULL,
	INDEX fk_payment_registration (Registration_Id ASC),
	CONSTRAINT fk_payment_registration
	FOREIGN KEY (Registration_Id) REFERENCES Registration(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
	INDEX fk_payment_account (Account_Id ASC),
	CONSTRAINT fk_payment_account
	FOREIGN KEY (Account_Id) REFERENCES Account(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS Knowledge_Activity (
	Id INT PRIMARY KEY AUTO_INCREMENT,
	Knowledge_Id INT NOT NULL,
	Activity_Id INT NOT NULL,
	INDEX fk_knowledge_activity_knowlegde (Knowledge_Id ASC),
	CONSTRAINT fk_knowledge_activity_knowlegde
	FOREIGN KEY (Knowledge_Id) REFERENCES Knowledge(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
	INDEX fk_knowlegde_activity_activity (Activity_Id ASC),
	CONSTRAINT fk_knowlegde_activity_activity
	FOREIGN KEY (Activity_Id) REFERENCES Activity(Id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;
