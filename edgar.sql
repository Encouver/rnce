
--------26/05/2015---------------

ALTER TABLE nombres_cajas
  ADD CONSTRAINT nombres_cajas_nombre_nacional_tipo_caja_contratista_id_key UNIQUE(nombre, nacional, tipo_caja, contratista_id);

ALTER TABLE nombres_cajas ADD COLUMN anho character varying(100);
ALTER TABLE nombres_cajas ALTER COLUMN anho SET NOT NULL;
COMMENT ON COLUMN nombres_cajas.anho IS 'Año contable y mes'


-- Table: cuentas.b1_cuentas_por_cobrar_comerciales

-- DROP TABLE cuentas.b1_cuentas_por_cobrar_comerciales;

CREATE TABLE cuentas.b1_cuentas_por_cobrar_comerciales
(
  id serial NOT NULL, -- Clave primaria
  concepto character varying(255) NOT NULL, -- Ventas servicios obras
  num_fact_contr character varying(255), -- Numero de factura o contrato
  monto numeric(38,6) NOT NULL, -- Monto de la factura o contrato
  porcentaje numeric(38,6) NOT NULL, -- Porcentaje
  corriente boolean, -- Indica si el tipo de cuenta es corriente
  nocorriente boolean, -- Indica si el tipo de cuenta es no corriente
  plazo_contrato_c integer NOT NULL DEFAULT 0, -- Plazo del contrato corriente
  saldo_c numeric(38,6) DEFAULT 0, -- Saldo segun contabilidad corriente
  deterioro_c boolean, -- Si posee o no deterioro
  valor_de_uso_c numeric(38,6) DEFAULT 0, -- Valor de uso
  saldo_neto_c numeric(38,6) DEFAULT 0, -- Saldo segun contabilidad corriente
  plazo_contrato_nc integer NOT NULL DEFAULT 0, -- Plazo del contrato no corriente
  saldo_nc numeric(38,6) DEFAULT 0, -- Saldo segun contabilidad no corriente
  deterioro_nc boolean, -- Si posee o no deterioro
  valor_de_uso_nc numeric(38,6) DEFAULT 0, -- Valor de uso no corriente
  saldo_neto_nc numeric(38,6) DEFAULT 0, -- Saldo segun contabilidad no corriente
  intereses numeric(38,6) DEFAULT 0, -- Intereses cobrado segun actividad economica
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT fk_b2_cuentas_por_cobrar_comerciales PRIMARY KEY (id),
  CONSTRAINT b1_cuentas_por_cobrar_comerciales_contratista_id_fkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.b1_cuentas_por_cobrar_comerciales
  OWNER TO postgres;
COMMENT ON TABLE cuentas.b1_cuentas_por_cobrar_comerciales
  IS 'Tabla correspondiende a la cuenta b2 otras cuentas por cobrar';
COMMENT ON COLUMN cuentas.b1_cuentas_por_cobrar_comerciales.id IS 'Clave primaria';
COMMENT ON COLUMN cuentas.b1_cuentas_por_cobrar_comerciales.concepto IS 'Ventas servicios obras';
COMMENT ON COLUMN cuentas.b1_cuentas_por_cobrar_comerciales.num_fact_contr IS 'Numero de factura o contrato';
COMMENT ON COLUMN cuentas.b1_cuentas_por_cobrar_comerciales.monto IS 'Monto de la factura o contrato';
COMMENT ON COLUMN cuentas.b1_cuentas_por_cobrar_comerciales.porcentaje IS 'Porcentaje';
COMMENT ON COLUMN cuentas.b1_cuentas_por_cobrar_comerciales.corriente IS 'Indica si el tipo de cuenta es corriente';
COMMENT ON COLUMN cuentas.b1_cuentas_por_cobrar_comerciales.nocorriente IS 'Indica si el tipo de cuenta es no corriente';
COMMENT ON COLUMN cuentas.b1_cuentas_por_cobrar_comerciales.plazo_contrato_c IS 'Plazo del contrato corriente';
COMMENT ON COLUMN cuentas.b1_cuentas_por_cobrar_comerciales.saldo_c IS 'Saldo segun contabilidad corriente';
COMMENT ON COLUMN cuentas.b1_cuentas_por_cobrar_comerciales.deterioro_c IS 'Si posee o no deterioro';
COMMENT ON COLUMN cuentas.b1_cuentas_por_cobrar_comerciales.valor_de_uso_c IS 'Valor de uso';
COMMENT ON COLUMN cuentas.b1_cuentas_por_cobrar_comerciales.saldo_neto_c IS 'Saldo segun contabilidad corriente';
COMMENT ON COLUMN cuentas.b1_cuentas_por_cobrar_comerciales.plazo_contrato_nc IS 'Plazo del contrato no corriente';
COMMENT ON COLUMN cuentas.b1_cuentas_por_cobrar_comerciales.saldo_nc IS 'Saldo segun contabilidad no corriente';
COMMENT ON COLUMN cuentas.b1_cuentas_por_cobrar_comerciales.deterioro_nc IS 'Si posee o no deterioro';
COMMENT ON COLUMN cuentas.b1_cuentas_por_cobrar_comerciales.valor_de_uso_nc IS ' Valor de uso no corriente';
COMMENT ON COLUMN cuentas.b1_cuentas_por_cobrar_comerciales.saldo_neto_nc IS ' Saldo segun contabilidad no corriente';
COMMENT ON COLUMN cuentas.b1_cuentas_por_cobrar_comerciales.intereses IS 'Intereses cobrado segun actividad economica';
COMMENT ON COLUMN cuentas.b1_cuentas_por_cobrar_comerciales.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.b1_cuentas_por_cobrar_comerciales.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.b1_cuentas_por_cobrar_comerciales.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.b1_cuentas_por_cobrar_comerciales.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.b1_cuentas_por_cobrar_comerciales.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.b1_cuentas_por_cobrar_comerciales.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.b1_cuentas_por_cobrar_comerciales.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.b1_cuentas_por_cobrar_comerciales.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';


-- Table: cuentas.b2_otras_cuentas_por_cobrar

-- DROP TABLE cuentas.b2_otras_cuentas_por_cobrar;

CREATE TABLE cuentas.b2_otras_cuentas_por_cobrar
(
  id serial NOT NULL, -- Clave primaria
  criterio character varying(255) NOT NULL, -- Puede tomar el valor EMPRESA, DIRECTOR, ACCIONISTA, OTROS
  origen character varying(255) NOT NULL, -- Origen la cuenta por cobrar
  fecha date NOT NULL, -- Fecha de la cuenta por pagar
  garantia character varying(255), -- Clave foranea a la tabla garantia
  corriente boolean, -- Indica si el tipo de cuenta es corriente
  nocorriente boolean, -- Indica si el tipo de cuenta es no corriente
  plazo_contrato_c integer NOT NULL DEFAULT 0, -- Plazo del contrato corriente
  saldo_neto_c numeric(38,6) DEFAULT 0, -- Saldo segun contabilidad corriente
  plazo_contrato_nc integer NOT NULL DEFAULT 0, -- Plazo del contrato no corriente
  saldo_neto_nc numeric(38,6) DEFAULT 0, -- Saldo segun contabilidad no corriente
  criterio_id integer, -- Clave "foranea via software" a la tabla indicada en criterio
  otro_nombre character varying(255), -- Indica si el tipo de cuenta por pagar es nomina, trabajadores, etc
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT fk_b2_otros_cuentas PRIMARY KEY (id),
  CONSTRAINT b2_otras_cuentas_por_cobrar_contratista_id_fkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.b2_otras_cuentas_por_cobrar
  OWNER TO postgres;
COMMENT ON TABLE cuentas.b2_otras_cuentas_por_cobrar
  IS 'Tabla correspondiende a la cuenta b2 otras cuentas por cobrar';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar.id IS 'Clave primaria';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar.criterio IS 'Puede tomar el valor EMPRESA, DIRECTOR, ACCIONISTA, OTROS';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar.origen IS 'Origen la cuenta por cobrar';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar.fecha IS 'Fecha de la cuenta por pagar';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar.garantia IS 'Clave foranea a la tabla garantia';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar.corriente IS 'Indica si el tipo de cuenta es corriente';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar.nocorriente IS 'Indica si el tipo de cuenta es no corriente';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar.plazo_contrato_c IS 'Plazo del contrato corriente';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar.saldo_neto_c IS 'Saldo segun contabilidad corriente';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar.plazo_contrato_nc IS 'Plazo del contrato no corriente';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar.saldo_neto_nc IS 'Saldo segun contabilidad no corriente';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar.criterio_id IS 'Clave "foranea via software" a la tabla indicada en criterio';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar.otro_nombre IS 'Indica si el tipo de cuenta por pagar es nomina, trabajadores, etc';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';

-- Table: cuentas.b2_otras_cuentas_por_cobrar_e

-- DROP TABLE cuentas.b2_otras_cuentas_por_cobrar_e;

CREATE TABLE cuentas.b2_otras_cuentas_por_cobrar_e
(
  id serial NOT NULL, -- Clave primaria
  criterio character varying(255) NOT NULL, -- Puede tomar el valor EMPRESA, DIRECTOR, ACCIONISTA, OTROS
  origen character varying(255) NOT NULL, -- Origen la cuenta por cobrar
  fecha date NOT NULL, -- Fecha de la cuenta por pagar
  garantia character varying(255), -- Clave foranea a la tabla garantia
  corriente boolean, -- Indica si el tipo de cuenta es corriente
  nocorriente boolean, -- Indica si el tipo de cuenta es no corriente
  plazo_contrato_c integer NOT NULL DEFAULT 0, -- Plazo del contrato corriente
  saldo_c numeric(38,6) DEFAULT 0, -- Saldo segun contabilidad corriente
  deterioro_c boolean, -- Si posee o no deterioro
  valor_de_uso_c numeric(38,6) DEFAULT 0, -- Valor de uso
  saldo_neto_c numeric(38,6) DEFAULT 0, -- Saldo segun contabilidad corriente
  plazo_contrato_nc integer NOT NULL DEFAULT 0, -- Plazo del contrato no corriente
  saldo_nc numeric(38,6) DEFAULT 0, -- Saldo segun contabilidad no corriente
  deterioro_nc boolean, -- Si posee o no deterioro
  valor_de_uso_nc numeric(38,6) DEFAULT 0, -- Valor de uso no corriente
  saldo_neto_nc numeric(38,6) DEFAULT 0, -- Saldo segun contabilidad no corriente
  otro_nombre character varying(255), -- Indica si el tipo de cuenta por pagar es nomina, trabajadores, etc
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT fk_b2_otros_cuentas_empresas PRIMARY KEY (id),
  CONSTRAINT b2_otras_cuentas_por_cobrar_e_contratista_id_fkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.b2_otras_cuentas_por_cobrar_e
  OWNER TO postgres;
COMMENT ON TABLE cuentas.b2_otras_cuentas_por_cobrar_e
  IS 'Tabla correspondiende a la cuenta b2 otras cuentas por cobrar';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.id IS 'Clave primaria';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.criterio IS 'Puede tomar el valor EMPRESA, DIRECTOR, ACCIONISTA, OTROS';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.origen IS 'Origen la cuenta por cobrar';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.fecha IS 'Fecha de la cuenta por pagar';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.garantia IS 'Clave foranea a la tabla garantia';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.corriente IS 'Indica si el tipo de cuenta es corriente';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.nocorriente IS 'Indica si el tipo de cuenta es no corriente';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.plazo_contrato_c IS 'Plazo del contrato corriente';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.saldo_c IS 'Saldo segun contabilidad corriente';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.deterioro_c IS 'Si posee o no deterioro';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.valor_de_uso_c IS 'Valor de uso';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.saldo_neto_c IS 'Saldo segun contabilidad corriente';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.plazo_contrato_nc IS 'Plazo del contrato no corriente';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.saldo_nc IS 'Saldo segun contabilidad no corriente';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.deterioro_nc IS 'Si posee o no deterioro';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.valor_de_uso_nc IS ' Valor de uso no corriente';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.saldo_neto_nc IS ' Saldo segun contabilidad no corriente';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.otro_nombre IS ' Indica si el tipo de cuenta por pagar es nomina, trabajadores, etc';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';


-- Table: cuentas.bb1_cuentas_por_pagar_comerciales

-- DROP TABLE cuentas.bb1_cuentas_por_pagar_comerciales;

CREATE TABLE cuentas.bb1_cuentas_por_pagar_comerciales
(
  id serial NOT NULL, -- Clave primaria
  proveedor_id integer NOT NULL, -- Clave foranea a la tabla Empresas relacionadas
  cantidad_factura integer NOT NULL, -- Cantidad facturas o documentos por pagar
  saldo_al_cierre numeric(38,6) NOT NULL, -- Saldo al cierre del ejercicio economico
  intereses_actividad_e numeric(38,6) NOT NULL DEFAULT 0, -- Intereses generados durante la actividad economica
  corriente boolean NOT NULL, -- Si el registro es corriente o no.
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT bb1_cuentas_por_pagar_comerciales_pkey PRIMARY KEY (id),
  CONSTRAINT bb1_cuentas_por_pagar_comerciales_contratista_id_fkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT bb1_cuentas_por_pagar_comerciales_proveedor_id_fkey FOREIGN KEY (proveedor_id)
      REFERENCES empresas_relacionadas (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.bb1_cuentas_por_pagar_comerciales
  OWNER TO eureka;
COMMENT ON TABLE cuentas.bb1_cuentas_por_pagar_comerciales
  IS 'Tabla que almacena datos referentes a la cuenta bb1';
COMMENT ON COLUMN cuentas.bb1_cuentas_por_pagar_comerciales.id IS 'Clave primaria';
COMMENT ON COLUMN cuentas.bb1_cuentas_por_pagar_comerciales.proveedor_id IS 'Clave foranea a la tabla Empresas relacionadas';
COMMENT ON COLUMN cuentas.bb1_cuentas_por_pagar_comerciales.cantidad_factura IS 'Cantidad facturas o documentos por pagar';
COMMENT ON COLUMN cuentas.bb1_cuentas_por_pagar_comerciales.saldo_al_cierre IS 'Saldo al cierre del ejercicio economico';
COMMENT ON COLUMN cuentas.bb1_cuentas_por_pagar_comerciales.intereses_actividad_e IS 'Intereses generados durante la actividad economica';
COMMENT ON COLUMN cuentas.bb1_cuentas_por_pagar_comerciales.corriente IS 'Si el registro es corriente o no.';
COMMENT ON COLUMN cuentas.bb1_cuentas_por_pagar_comerciales.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.bb1_cuentas_por_pagar_comerciales.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.bb1_cuentas_por_pagar_comerciales.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.bb1_cuentas_por_pagar_comerciales.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.bb1_cuentas_por_pagar_comerciales.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.bb1_cuentas_por_pagar_comerciales.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.bb1_cuentas_por_pagar_comerciales.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.bb1_cuentas_por_pagar_comerciales.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';


-- Table: cuentas.bb2_otras_cuentas_por_pagar

-- DROP TABLE cuentas.bb2_otras_cuentas_por_pagar;

CREATE TABLE cuentas.bb2_otras_cuentas_por_pagar
(
  id serial NOT NULL, -- Clave primaria
  criterio character varying(255) NOT NULL, -- Puede tomar el valor EMPRESA, DIRECTOR, ACCIONISTA, OTROS
  fecha date NOT NULL, -- Fecha de la cuenta por pagar
  garantia integer NOT NULL, -- Clave foranea a la tabla garantia
  plazo integer NOT NULL, -- Cantidad de meses
  saldo_conta_co numeric(38,6) NOT NULL, -- Saldo segun contabilidad corriente
  saldo_conta_nc numeric(38,6) NOT NULL, -- Saldo segun contabilidad no corriente
  intereses numeric(38,6) NOT NULL DEFAULT 0, -- Intereses generados
  criterio_id integer, -- Clave "foranea via software" a la tabla indicada en criterio
  otro_nombre character varying(255), -- Indica si el tipo de cuenta por pagar es nomina, trabajadores, etc
  detalle text NOT NULL, -- Detalle de la cuenta por pagar
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT bb2_otras_cuentas_por_pagar_pkey PRIMARY KEY (id),
  CONSTRAINT bb2_otras_cuentas_por_pagar_contratista_id_fkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fk_garantia_bb2_fk FOREIGN KEY (garantia)
      REFERENCES cuentas.bb2_garantias (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.bb2_otras_cuentas_por_pagar
  OWNER TO eureka;
COMMENT ON TABLE cuentas.bb2_otras_cuentas_por_pagar
  IS 'Tabla que hace referecia a la cuenta bb-2';
COMMENT ON COLUMN cuentas.bb2_otras_cuentas_por_pagar.id IS 'Clave primaria';
COMMENT ON COLUMN cuentas.bb2_otras_cuentas_por_pagar.criterio IS 'Puede tomar el valor EMPRESA, DIRECTOR, ACCIONISTA, OTROS';
COMMENT ON COLUMN cuentas.bb2_otras_cuentas_por_pagar.fecha IS 'Fecha de la cuenta por pagar';
COMMENT ON COLUMN cuentas.bb2_otras_cuentas_por_pagar.garantia IS 'Clave foranea a la tabla garantia';
COMMENT ON COLUMN cuentas.bb2_otras_cuentas_por_pagar.plazo IS 'Cantidad de meses ';
COMMENT ON COLUMN cuentas.bb2_otras_cuentas_por_pagar.saldo_conta_co IS 'Saldo segun contabilidad corriente';
COMMENT ON COLUMN cuentas.bb2_otras_cuentas_por_pagar.saldo_conta_nc IS 'Saldo segun contabilidad no corriente';
COMMENT ON COLUMN cuentas.bb2_otras_cuentas_por_pagar.intereses IS 'Intereses generados';
COMMENT ON COLUMN cuentas.bb2_otras_cuentas_por_pagar.criterio_id IS 'Clave "foranea via software" a la tabla indicada en criterio';
COMMENT ON COLUMN cuentas.bb2_otras_cuentas_por_pagar.otro_nombre IS 'Indica si el tipo de cuenta por pagar es nomina, trabajadores, etc';
COMMENT ON COLUMN cuentas.bb2_otras_cuentas_por_pagar.detalle IS 'Detalle de la cuenta por pagar';
COMMENT ON COLUMN cuentas.bb2_otras_cuentas_por_pagar.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.bb2_otras_cuentas_por_pagar.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.bb2_otras_cuentas_por_pagar.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.bb2_otras_cuentas_por_pagar.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.bb2_otras_cuentas_por_pagar.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.bb2_otras_cuentas_por_pagar.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.bb2_otras_cuentas_por_pagar.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.bb2_otras_cuentas_por_pagar.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';


-- Index: cuentas.fki_garantia_bb2_fk

-- DROP INDEX cuentas.fki_garantia_bb2_fk;

CREATE INDEX fki_garantia_bb2_fk
  ON cuentas.bb2_otras_cuentas_por_pagar
  USING btree
  (garantia);
  

CREATE TABLE cuentas.bb2_garantias
(
  id serial NOT NULL, -- Clave primaria
  classname_id integer NOT NULL, -- Clave "foranea via software"  para la garantia indicada por la cuenta.
  tipo character varying(255), -- Tipo de garantia que indico el contratista
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT sys_garantia_pkey PRIMARY KEY (id),
  CONSTRAINT bb2_garantias_contratista_id_fkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.bb2_garantias
  OWNER TO eureka;
COMMENT ON TABLE cuentas.bb2_garantias
  IS 'Tabla que almacena las garantias dispuestas por las cuentas.';
COMMENT ON COLUMN cuentas.bb2_garantias.id IS 'Clave foranea';
COMMENT ON COLUMN cuentas.bb2_garantias.classname_id IS 'Clave "foranea via software"  para la garantia indicada por la cuenta.';
COMMENT ON COLUMN cuentas.bb2_garantias.tipo IS 'Tipo de garantia que indico el contratista';
COMMENT ON COLUMN cuentas.bb2_garantias.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.bb2_garantias.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.bb2_garantias.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.bb2_garantias.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.bb2_garantias.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.bb2_garantias.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.bb2_garantias.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.bb2_garantias.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';


--------29/05/2015--------------

ALTER TABLE cuentas.b2_otras_cuentas_por_cobrar_e ADD COLUMN empresa integer;
COMMENT ON COLUMN cuentas.b2_otras_cuentas_por_cobrar_e.empresa IS 'Clave foranea a la tabla empresas relacionadas';

ALTER TABLE cuentas.b2_otras_cuentas_por_cobrar_e
  ADD CONSTRAINT fk_empresa_b2_cuentas_e FOREIGN KEY (empresa)
      REFERENCES empresas_relacionadas (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION;
-------------------31/05/2015---------------------
ALTER TABLE cuentas.b2_otras_cuentas_por_cobrar_e RENAME empresa  TO empresa_id;


ALTER TABLE empresas_relacionadas
   ADD COLUMN contratista_id integer NOT NULL;
COMMENT ON COLUMN empresas_relacionadas.contratista_id
  IS 'Clave foranea a la tabla Contratista';
  
ALTER TABLE empresas_relacionadas
  ADD CONSTRAINT fk_contratista_empresar_relaci FOREIGN KEY (contratista_id) REFERENCES contratistas (id)
   ON UPDATE NO ACTION ON DELETE NO ACTION;
CREATE INDEX fki_contratista_empresar_relaci
  ON empresas_relacionadas(contratista_id);
  
----------------07/06/2015--------CAMBIOS LUEGO DE MONTAR LA BD DE MARCOS DE FECHA 05/06-------

ALTER TABLE cuentas.jj_proviciones
   ADD COLUMN otro_nombre character varying(255);
COMMENT ON COLUMN cuentas.jj_proviciones.otro_nombre
  IS 'Campo que complementa la informacion seleccionada en conceptos por Otros.';
  
  
------------------09/06/2015------------
-- Column: tipo

-- ALTER TABLE cuentas.sys_conceptos DROP COLUMN tipo;

ALTER TABLE cuentas.sys_conceptos ADD COLUMN tipo character varying(255);
COMMENT ON COLUMN cuentas.sys_conceptos.tipo IS 'Clasificacion de mayor nivel a los items de las cuentas.';




