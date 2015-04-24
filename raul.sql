 ALTER TABLE personas_naturales DROP COLUMN ci;

ALTER TABLE personas_naturales ADD COLUMN ci integer;
COMMENT ON COLUMN personas_naturales.ci IS 'Cedula de identidad de la persona registrada';


- ALTER TABLE bancos_contratistas DROP COLUMN num_cuenta;

ALTER TABLE bancos_contratistas ADD COLUMN num_cuenta character(100);
ALTER TABLE bancos_contratistas ALTER COLUMN num_cuenta SET NOT NULL;
COMMENT ON COLUMN bancos_contratistas.num_cuenta IS 'Numero de cuenta';

-- ALTER TABLE actividades_economicas DROP COLUMN ppal_experiencia;

ALTER TABLE actividades_economicas ADD COLUMN ppal_experiencia integer;
ALTER TABLE actividades_economicas ALTER COLUMN ppal_experiencia SET NOT NULL;
COMMENT ON COLUMN actividades_economicas.ppal_experiencia IS 'Experiencia de la actividad economica principal';

-- ALTER TABLE actividades_economicas DROP COLUMN comp1_experiencia;

ALTER TABLE actividades_economicas ADD COLUMN comp1_experiencia integer;
ALTER TABLE actividades_economicas ALTER COLUMN comp1_experiencia SET NOT NULL;
COMMENT ON COLUMN actividades_economicas.comp1_experiencia IS 'Experiencia de la actividad economica complementaria 1';

-- ALTER TABLE actividades_economicas DROP COLUMN comp2_experiencia;

ALTER TABLE actividades_economicas ADD COLUMN comp2_experiencia integer;
COMMENT ON COLUMN actividades_economicas.comp2_experiencia IS 'Experiencia de la actividad economica complementaria 2';

