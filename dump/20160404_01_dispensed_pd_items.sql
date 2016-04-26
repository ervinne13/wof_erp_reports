-- Table: "tblINV_DispensedPDItems"

-- DROP TABLE "tblINV_DispensedPDItems";

CREATE TABLE "tblINV_DispensedPDItems"
(
  "DIP_DI_DocNo" character varying(30) NOT NULL,
  "DIP_Location" character varying(30) NOT NULL,
  "DIP_MachineNo" character varying(30) NOT NULL,
  "DIP_MachineTag" character varying(30) NOT NULL,
  "DIP_ItemNo" character varying(30) NOT NULL,
  "DIP_WeekNo" character varying(30) NOT NULL,
  "DIP_LineNo" bigserial NOT NULL,
  "DIP_RetrievalDate" timestamp without time zone NOT NULL,
  "DIP_Beg" bigint NOT NULL,
  "DIP_End" bigint NOT NULL,
  "DIP_Captured" bigint NOT NULL,
  "DIP_Retrieved" bit(1) NOT NULL,
  "CreatedBy" character varying(20),
  "DateCreated" timestamp without time zone,
  "ModifiedBy" character varying(20),
  "DateModified" timestamp without time zone,
  CONSTRAINT "DIP_DI_DocNo" PRIMARY KEY ("DIP_LineNo", "DIP_DI_DocNo", "DIP_MachineTag"),
  CONSTRAINT "PFK_Dispensed_PDItems" FOREIGN KEY ("DIP_DI_DocNo")
      REFERENCES "tblINV_Dispensed" ("DI_DocNo") MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT
)
WITH (
  OIDS=FALSE
);
ALTER TABLE "tblINV_DispensedPDItems"
  OWNER TO postgres;
