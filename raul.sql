--17 mayo 2015

ALTER TABLE acciones ALTER COLUMN tipo_accion SET NOT NULL;
ALTER TABLE duraciones_empresas DROP COLUMN "duracion_años";


ALTER TABLE activos.documentos_registrados ALTER COLUMN valor_adquisicion DROP NOT NULL;



-- 18 mayo 2015

ALTER TABLE certificados DROP COLUMN acta_constitutiva_id;

ALTER TABLE certificados ADD COLUMN documento_registrado_id integer;
ALTER TABLE certificados ALTER COLUMN documento_registrado_id SET NOT NULL;
COMMENT ON COLUMN certificados.documento_registrado_id IS 'Clave foranea a la tabla documentos_registrados';

ALTER TABLE certificados ADD COLUMN contratista_id integer;
ALTER TABLE certificados ALTER COLUMN contratista_id SET NOT NULL;
COMMENT ON COLUMN certificados.contratista_id IS 'Clave foranea a la tabla contratistas';


ALTER TABLE certificados
  ADD CONSTRAINT certificados_contratista_id_fkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE;


ALTER TABLE certificados
  ADD CONSTRAINT certificados_documento_registrado_id_fkey FOREIGN KEY (documento_registrado_id)
      REFERENCES activos.documentos_registrados (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE;


ALTER TABLE suplementarios DROP COLUMN acta_constitutiva_id;

ALTER TABLE suplementarios ADD COLUMN documento_registrado_id integer;
ALTER TABLE suplementarios ALTER COLUMN documento_registrado_id SET NOT NULL;
COMMENT ON COLUMN suplementarios.documento_registrado_id IS 'Clave foranea a la tabla documentos_registrados';

ALTER TABLE suplementarios ADD COLUMN contratista_id integer;
ALTER TABLE suplementarios ALTER COLUMN contratista_id SET NOT NULL;
COMMENT ON COLUMN suplementarios.contratista_id IS 'Clave foranea a la tabla contratistas';



ALTER TABLE suplementarios
  ADD CONSTRAINT suplementarios_contratista_id_fkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE;



ALTER TABLE suplementarios
  ADD CONSTRAINT suplementarios_documento_registrado_id_fkey FOREIGN KEY (documento_registrado_id)
      REFERENCES activos.documentos_registrados (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE;
