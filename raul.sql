ALTER TABLE contratistas ADD COLUMN acta_constitutiva boolean;
ALTER TABLE contratistas ALTER COLUMN acta_constitutiva SET NOT NULL;
ALTER TABLE contratistas ALTER COLUMN acta_constitutiva SET DEFAULT false;
COMMENT ON COLUMN contratistas.acta_constitutiva IS 'Indica si el acta constitutiva ya fue cargada';

ALTER TABLE contratistas DROP COLUMN acta_constitutiva;

ALTER TABLE denominaciones_comerciales ADD COLUMN documento_registrado_id integer;
ALTER TABLE denominaciones_comerciales ALTER COLUMN documento_registrado_id SET NOT NULL;
COMMENT ON COLUMN denominaciones_comerciales.documento_registrado_id IS 'Clave foranea a la tabla documentos_registrados';
