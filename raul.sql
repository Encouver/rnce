 ALTER TABLE personas_naturales DROP COLUMN ci;

ALTER TABLE personas_naturales ADD COLUMN ci integer;
COMMENT ON COLUMN personas_naturales.ci IS 'Cedula de identidad de la persona registrada';


- ALTER TABLE bancos_contratistas DROP COLUMN num_cuenta;

ALTER TABLE bancos_contratistas ADD COLUMN num_cuenta character(100);
ALTER TABLE bancos_contratistas ALTER COLUMN num_cuenta SET NOT NULL;
COMMENT ON COLUMN bancos_contratistas.num_cuenta IS 'Numero de cuenta';
