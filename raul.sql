 ALTER TABLE personas_naturales DROP COLUMN ci;

ALTER TABLE personas_naturales ADD COLUMN ci integer;
COMMENT ON COLUMN personas_naturales.ci IS 'Cedula de identidad de la persona registrada';
