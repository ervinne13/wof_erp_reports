/*
Created: 4/5/2016
Modified: 4/7/2016
Model: JO
Database: PostgreSQL 9.2
*/


-- Create tables section -------------------------------------------------

-- Table tblCOM_JO

CREATE TABLE "tblCOM_JO"(
 "JO_DocNo" Character varying(30) NOT NULL,
 "JO_DocDate" Timestamp NOT NULL,
 "JO_RefNo" Character varying(30),
 "JO_Remarks" Text,
 "JO_Location" Character varying(30) NOT NULL,
 "JO_Company" Character varying(30) NOT NULL,
 "JO_Status" Character varying(30) NOT NULL,
 "JO_AssetID" Character varying(20) NOT NULL,
 "JO_ItemNo" Character varying(30) NOT NULL,
 "JO_ItemDescription" Character varying(200) NOT NULL,
 "JO_NatureOfDefect" Character varying(100) NOT NULL,
 "JO_JobNeeded" Character varying(100) NOT NULL,
 "JO_Technician" Character varying(100) NOT NULL,
 "JO_DateDown" Timestamp,
 "JO_DateOperational" Timestamp,
 "JO_DowntimeDays" Numeric(12,4),
 "CreatedBy" Character varying(20),
 "DateCreated" Timestamp,
 "ModifiedBy" Character varying(20),
 "DateModified" Timestamp
)
WITH (OIDS=FALSE)
;

-- Add keys for table tblCOM_JO

ALTER TABLE "tblCOM_JO" ADD CONSTRAINT "JO_DocNo" PRIMARY KEY ("JO_DocNo")
;

-- Table tblCOM_JODetail

CREATE TABLE "tblCOM_JODetail"(
 "JOD_JO_DocNo" Character varying(30) NOT NULL,
 "JOD_LineNo" BigSerial NOT NULL,
 "JOD_Date" Timestamp NOT NULL,
 "JOD_ActionTaken" Text NOT NULL,
 "JOD_UserID" Character varying(20) NOT NULL,
 "CreatedBy" Character varying(20),
 "DateCreated" Timestamp,
 "ModifiedBy" Character varying(20),
 "DateModified" Timestamp
)
WITH (OIDS=FALSE)
;

-- Add keys for table tblCOM_JODetail

ALTER TABLE "tblCOM_JODetail" ADD CONSTRAINT "JOD_JO_DocNo" PRIMARY KEY 

("JOD_JO_DocNo","JOD_LineNo")
;

-- Create relationships section ------------------------------------------------- 

ALTER TABLE "tblCOM_JODetail" ADD CONSTRAINT "PFK_JO_Detail" FOREIGN KEY ("JOD_JO_DocNo") 

REFERENCES "tblCOM_JO" ("JO_DocNo") ON DELETE RESTRICT ON UPDATE CASCADE
;




