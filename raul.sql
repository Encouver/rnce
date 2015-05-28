ALTER TABLE contratistas ADD COLUMN acta_constitutiva boolean;
ALTER TABLE contratistas ALTER COLUMN acta_constitutiva SET NOT NULL;
ALTER TABLE contratistas ALTER COLUMN acta_constitutiva SET DEFAULT false;
COMMENT ON COLUMN contratistas.acta_constitutiva IS 'Indica si el acta constitutiva ya fue cargada';

ALTER TABLE contratistas DROP COLUMN acta_constitutiva;

ALTER TABLE denominaciones_comerciales ADD COLUMN documento_registrado_id integer;
ALTER TABLE denominaciones_comerciales ALTER COLUMN documento_registrado_id SET NOT NULL;
COMMENT ON COLUMN denominaciones_comerciales.documento_registrado_id IS 'Clave foranea a la tabla documentos_registrados';

ALTER TABLE activos.documentos_registrados ADD COLUMN proceso_finalizado boolean;
ALTER TABLE activos.documentos_registrados ALTER COLUMN proceso_finalizado SET NOT NULL;
ALTER TABLE activos.documentos_registrados ALTER COLUMN proceso_finalizado SET DEFAULT true;
COMMENT ON COLUMN activos.documentos_registrados.proceso_finalizado IS 'Junto a tipo_documento_id me indica si es un acta o una modificacion';
