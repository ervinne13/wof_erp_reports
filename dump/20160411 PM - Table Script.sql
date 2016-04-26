/*
Created: 4/8/2016
Modified: 4/11/2016
Model: PM
Database: PostgreSQL 9.2
*/


-- Create tables section -------------------------------------------------

-- Table tblINV_PM

CREATE TABLE "tblINV_PM"(
 "PM_DocNo" Character varying(30) NOT NULL,
 "PM_DocDate" Timestamp NOT NULL,
 "PM_Location" Character varying(30) NOT NULL,
 "PM_Period" Character varying(30) NOT NULL,
 "PM_OtherConcern" Text,
 "PM_Company" Character varying(30) NOT NULL,
 "PM_CompletionRate" Numeric(12,4) NOT NULL,
 "PM_QualityRate" Numeric(12,4) NOT NULL,
 "PM_Status" Character varying(20) NOT NULL,
 "CreatedBy" Character varying(20),
 "DateCreated" Timestamp,
 "ModifiedBy" Character varying(20),
 "DateModified" Timestamp
)
WITH (OIDS=FALSE)
;

-- Add keys for table tblINV_PM

ALTER TABLE "tblINV_PM" ADD CONSTRAINT "PM_DocNo" PRIMARY KEY ("PM_DocNo")
;

-- Table tblINV_PMDetail

CREATE TABLE "tblINV_PMDetail"(
 "PMD_PM_DocNo" Character varying(30) NOT NULL,
 "PMD_LineNo" BigSerial NOT NULL,
 "PMD_AssetID" Character varying(30) NOT NULL,
 "PMD_ItemNo" Character varying(30) NOT NULL,
 "PMD_MachineName" Character varying(250) NOT NULL,
 "PMD_PMSched" Timestamp NOT NULL,
 "PMD_PreviousFindings" Text,
 "PMD_BTActualPMDate" Timestamp,
 "PMD_BTRemarks" Text,
 "PMD_BTUserID" Character varying(30),
 "PMD_ATRating" Bit(1),
 "PMD_ATRemarks" Text,
 "PMD_ATUserID" Character varying(30),
 "CreatedBy" Character varying(20),
 "DateCreated" Timestamp,
 "ModifiedBy" Character varying(20),
 "DateModified" Timestamp
)
WITH (OIDS=FALSE)
;

-- Add keys for table tblINV_PMDetail

ALTER TABLE "tblINV_PMDetail" ADD CONSTRAINT "PMD_PM_DocNo" PRIMARY KEY ("PMD_PM_DocNo","PMD_LineNo")
;

-- Create relationships section ------------------------------------------------- 

ALTER TABLE "tblINV_PMDetail" ADD CONSTRAINT "PFK_PM_Detail" FOREIGN KEY ("PMD_PM_DocNo") REFERENCES "tblINV_PM" ("PM_DocNo") ON DELETE RESTRICT ON UPDATE CASCADE
;




