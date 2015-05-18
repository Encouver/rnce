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


---------sprint 2 18 mayo 2015---------------

CREATE TYPE tipo_origen as enum ('EFECTIVO','EECTIVO EN BANCO','PROPIEDADES PLANTAS Y EQUIPOS','INVENTARIO DE MERCANCIA','ACTIVOS BIOLOGICOS','ACTIVOS INTANGIBLES','CUENTAS POR PAGAR ACCIONISTAS');


-- Table: origenes_capitales

-- DROP TABLE origenes_capitales;

CREATE TABLE origenes_capitales
(
  id integer NOT NULL DEFAULT nextval('"origenes _capitales_id_seq"'::regclass), -- Clave Primaria
  tipo_origen tipo_origen NOT NULL, -- tipo origen puede ser  EFECTIVO, EECTIVO EN BANCO, PROPIEDADES PLANTAS Y EQUIPOS, INVENTARIO DE MERCANCIA, ACTIVOS BIOLOGICOS, ACTIVOS INTANGIBLES, CUENTAS POR PAGAR ACCIONISTAS
  bien_id integer, -- Clave foranea a la tabla bienes
  banco_contratista_id integer, -- Clave foranea a la tabla bancos_contratistas
  monto numeric(38,6) NOT NULL, -- Monto
  fecha date, -- Fecha
  saldo_cierre_anterior numeric(38,6), -- Saldo al cierre del ejercicio anterior, en caso de ser una cuenta por pagar
  saldo_corte numeric(38,6), -- Saldo al corte en caso de ser una cuenta por pagar
  fecha_corte date, -- fecha del corte en caso de ser cuentas po pagar
  monto_aumento numeric(38,6), -- monto del aumento en caso de ser cuentas por pagar y decreto didiendo
  saldo_aumento numeric(38,6), -- saldo despues del aumento en caso de ser cuentas por pagar
  numero_accion integer, -- Numero de acciones en caso de ser ser decreto dividiendo
  valor_acciones numeric(38,6), -- Valor de las acciones en casa de ser decreto dividiendo
  saldo_cierre_ajustado numeric(38,6), -- Saldo al cierre del ejercicio anterior a valores ajustados en caso de ser decreto dividiendo
  fecha_aumento date, -- Fecha del aumento en caso de ser decreto dividiendo
  contratista_id integer NOT NULL, -- Clave foranea a la tabla contratistas
  documento_registrado_id integer NOT NULL, -- Clave foranea a la tabla documentos_registrados
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT origenes_capitales_id_pkey PRIMARY KEY (id),
  CONSTRAINT origenes_capitales_banco_contratista_id_pkey FOREIGN KEY (banco_contratista_id)
      REFERENCES bancos_contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT origenes_capitales_bien_id_pkey FOREIGN KEY (bien_id)
      REFERENCES activos.bienes (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT origenes_capitales_contratistda_id_pkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT origenes_capitales_documentos_registrados_id_pkey FOREIGN KEY (documento_registrado_id)
      REFERENCES activos.documentos_registrados (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE origenes_capitales
  OWNER TO eureka;
COMMENT ON TABLE origenes_capitales
  IS 'Tabla que almacena el origen del capital';
COMMENT ON COLUMN origenes_capitales.id IS 'Clave Primaria';
COMMENT ON COLUMN origenes_capitales.tipo_origen IS ' tipo origen puede ser  EFECTIVO, EECTIVO EN BANCO, PROPIEDADES PLANTAS Y EQUIPOS, INVENTARIO DE MERCANCIA, ACTIVOS BIOLOGICOS, ACTIVOS INTANGIBLES, CUENTAS POR PAGAR ACCIONISTAS';
COMMENT ON COLUMN origenes_capitales.bien_id IS 'Clave foranea a la tabla bienes';
COMMENT ON COLUMN origenes_capitales.banco_contratista_id IS 'Clave foranea a la tabla bancos_contratistas';
COMMENT ON COLUMN origenes_capitales.monto IS 'Monto';
COMMENT ON COLUMN origenes_capitales.fecha IS 'Fecha';
COMMENT ON COLUMN origenes_capitales.saldo_cierre_anterior IS 'Saldo al cierre del ejercicio anterior, en caso de ser una cuenta por pagar';
COMMENT ON COLUMN origenes_capitales.saldo_corte IS 'Saldo al corte en caso de ser una cuenta por pagar';
COMMENT ON COLUMN origenes_capitales.fecha_corte IS 'fecha del corte en caso de ser cuentas po pagar';
COMMENT ON COLUMN origenes_capitales.monto_aumento IS 'monto del aumento en caso de ser cuentas por pagar y decreto didiendo';
COMMENT ON COLUMN origenes_capitales.saldo_aumento IS 'saldo despues del aumento en caso de ser cuentas por pagar';
COMMENT ON COLUMN origenes_capitales.numero_accion IS 'Numero de acciones en caso de ser ser decreto dividiendo';
COMMENT ON COLUMN origenes_capitales.valor_acciones IS 'Valor de las acciones en casa de ser decreto dividiendo';
COMMENT ON COLUMN origenes_capitales.saldo_cierre_ajustado IS 'Saldo al cierre del ejercicio anterior a valores ajustados en caso de ser decreto dividiendo';
COMMENT ON COLUMN origenes_capitales.fecha_aumento IS 'Fecha del aumento en caso de ser decreto dividiendo';
COMMENT ON COLUMN origenes_capitales.contratista_id IS 'Clave foranea a la tabla contratistas';
COMMENT ON COLUMN origenes_capitales.documento_registrado_id IS 'Clave foranea a la tabla documentos_registrados';
COMMENT ON COLUMN origenes_capitales.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN origenes_capitales.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN origenes_capitales.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN origenes_capitales.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN origenes_capitales.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN origenes_capitales.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';

