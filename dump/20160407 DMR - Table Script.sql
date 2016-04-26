/*
Created: 4/7/2016
Modified: 4/7/2016
Model: DMR
Database: PostgreSQL 9.2
*/


-- Create tables section -------------------------------------------------

-- Table tblCOM_DMR

CREATE TABLE "tblCOM_DMR"(
 "DMR_DocNo" Character varying(30) NOT NULL,
 "DMR_DocDate" Timestamp NOT NULL,
 "DMR_RefNo" Character varying(30),
 "DMR_Remarks" Text,
 "DMR_Location" Character varying(30) NOT NULL,
 "DMR_Company" Character varying(30) NOT NULL,
 "DMR_Status" Character varying(30) NOT NULL,
 "DMR_AssetID" Character varying(20) NOT NULL,
 "DMR_ItemNo" Character varying(30) NOT NULL,
 "DMR_ItemDescription" Character varying(200) NOT NULL,
 "DMR_NatureOfDefect" Character varying(100) NOT NULL,
 "DMR_JobNeeded" Character varying(100) NOT NULL,
 "DMR_Technician" Character varying(100) NOT NULL,
 "DMR_DateDown" Timestamp,
 "DMR_DateOperational" Timestamp,
 "DMR_DowntimeDays" Numeric(12,4),
 "CreatedBy" Character varying(20),
 "DateCreated" Timestamp,
 "ModifiedBy" Character varying(20),
 "DateModified" Timestamp
)
WITH (OIDS=FALSE)
;

-- Add keys for table tblCOM_DMR

ALTER TABLE "tblCOM_DMR" ADD CONSTRAINT "DMR_DocNo" PRIMARY KEY ("DMR_DocNo")
;

-- Table tblCOM_DMRDetail

CREATE TABLE "tblCOM_DMRDetail"(
 "DMRD_DMR_DocNo" Character varying(30) NOT NULL,
 "DMRD_LineNo" BigSerial NOT NULL,
 "DMRD_Date" Timestamp NOT NULL,
 "DMRD_ActionTaken" Text NOT NULL,
 "DMRD_UserID" Character varying(20) NOT NULL,
 "CreatedBy" Character varying(20),
 "DateCreated" Timestamp,
 "ModifiedBy" Character varying(20),
 "DateModified" Timestamp
)
WITH (OIDS=FALSE)
;

-- Add keys for table tblCOM_DMRDetail

ALTER TABLE "tblCOM_DMRDetail" ADD CONSTRAINT "DMRD_DMR_DocNo" PRIMARY KEY ("DMRD_DMR_DocNo","DMRD_LineNo")
;

-- Create relationships section ------------------------------------------------- 

ALTER TABLE "tblCOM_DMRDetail" ADD CONSTRAINT "PFK_DMR_Detail" FOREIGN KEY ("DMRD_DMR_DocNo") REFERENCES "tblCOM_DMR" ("DMR_DocNo") ON DELETE RESTRICT ON UPDATE CASCADE
;




