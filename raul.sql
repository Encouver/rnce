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



----27 mayo 10:30 pm--

ALTER TABLE principios_contables DROP COLUMN principio_contable;

ALTER TABLE principios_contables ADD COLUMN principio_contable character varying(100);
ALTER TABLE principios_contables ALTER COLUMN principio_contable SET NOT NULL;
COMMENT ON COLUMN principios_contables.principio_contable IS 'Nombre del principio contable aplicable';


-----28 mayo 12:51 am----
ALTER TABLE denominaciones_comerciales
  ADD CONSTRAINT denominaciones_comerciales_documento_registrado_id_fkey FOREIGN KEY (documento_registrado_id)
      REFERENCES activos.documentos_registrados (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION;



ALTER TABLE razones_sociales ADD COLUMN documento_registrado_id integer;
ALTER TABLE razones_sociales ALTER COLUMN documento_registrado_id SET NOT NULL;
COMMENT ON COLUMN razones_sociales.documento_registrado_id IS 'Clave foranea a la tabla documentos registrados del esquema activos';


ALTER TABLE razones_sociales
  ADD CONSTRAINT razones_sociales_documento_registrado_id_fkey FOREIGN KEY (documento_registrado_id)
      REFERENCES activos.documentos_registrados (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION;

ALTER TABLE duraciones_empresas DROP COLUMN fecha_vencimiento;


------28 mayo 2015 4:00 pm---

ALTER TABLE sys_naturales_juridicas ADD COLUMN nacional boolean;
ALTER TABLE sys_naturales_juridicas ALTER COLUMN nacional SET NOT NULL;
ALTER TABLE sys_naturales_juridicas ALTER COLUMN nacional SET DEFAULT true;
COMMENT ON COLUMN sys_naturales_juridicas.nacional IS 'true nacionalidad es venezolano, false extranjero';

ALTER TABLE personas_juridicas ALTER COLUMN rif SET NOT NULL;
ALTER TABLE personas_naturales ALTER COLUMN rif SET NOT NULL;

ALTER TABLE personas_juridicas ALTER COLUMN tipo_nacionalidad SET NOT NULL;
ALTER TABLE personas_juridicas ALTER COLUMN tipo_nacionalidad SET DEFAULT 'NACIONAL'::tipo_nacionalidad;
ALTER TABLE personas_juridicas ALTER COLUMN tipo_nacionalidad DROP DEFAULT;

ALTER TABLE personas_juridicas ALTER COLUMN sys_pais_id SET NOT NULL;