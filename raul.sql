--15 mayo 2015

ALTER TABLE acciones DROP COLUMN acta_constitutiva_id;

ALTER TABLE acciones ADD COLUMN documento_registrado_id integer;
ALTER TABLE acciones ALTER COLUMN documento_registrado_id SET NOT NULL;
COMMENT ON COLUMN acciones.documento_registrado_id IS 'CLave foranea a la tabla documentos registrados';


ALTER TABLE acciones ADD COLUMN contratista_id integer;
ALTER TABLE acciones ALTER COLUMN contratista_id SET NOT NULL;
COMMENT ON COLUMN acciones.contratista_id IS 'Clave foranea a la tabal contratistas';



ALTER TABLE acciones
  ADD CONSTRAINT acciones_contratista_id_fkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE;



ALTER TABLE acciones
  ADD CONSTRAINT acciones_documento_registrado_id_fkey FOREIGN KEY (documento_registrado_id)
      REFERENCES activos.documentos_registrados (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE acciones Alter COLUMN numero_preferencial drop not null;

ALTER TYPE tipo_capital ADD VALUE 'PRINCIPAL' AFTER 'PRNCIPAL';


-- Campo borrado en la bd de marcos



ALTER TABLE activos.documentos_registrados ADD COLUMN sys_tipo_registro_id integer;
ALTER TABLE activos.documentos_registrados ALTER COLUMN sys_tipo_registro_id SET NOT NULL;
COMMENT ON COLUMN activos.documentos_registrados.sys_tipo_registro_id IS 'Clave foranea a la tabla Tipo Registro';

ALTER TABLE activos.documentos_registrados
  ADD CONSTRAINT fk_tipos_registros_registrados FOREIGN KEY (sys_tipo_registro_id)
      REFERENCES activos.sys_tipos_registros (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE;


-- Marcoos debes eliminar el campo que tienes ahi señalado como tipo_documento_id si mal no recuerdo y dentro de la tabla
-- sys_tipos_registros agregar un registro llamado ACTA CONSTITUTIVA de id 1



--17 mayo 2015

ALTER TABLE acciones ALTER COLUMN tipo_accion SET NOT NULL;