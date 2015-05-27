
--------26/05/2015---------------

ALTER TABLE nombres_cajas
  ADD CONSTRAINT nombres_cajas_nombre_nacional_tipo_caja_contratista_id_key UNIQUE(nombre, nacional, tipo_caja, contratista_id);

ALTER TABLE nombres_cajas ADD COLUMN anho character varying(100);
ALTER TABLE nombres_cajas ALTER COLUMN anho SET NOT NULL;
COMMENT ON COLUMN nombres_cajas.anho IS 'Año contable y mes'


CREATE TABLE cuentas.sys_garantia
(
  id serial NOT NULL, -- Clave foranea
  classname_id integer NOT NULL, -- Clave "foranea via software"  para la garantia indicada por la cuenta.
  tipo character varying(255), -- Tipo de garantia que indico el contratista
  CONSTRAINT sys_garantia_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.sys_garantia
  OWNER TO eureka;
COMMENT ON TABLE cuentas.sys_garantia
  IS 'Tabla que almacena las garantias dispuestas por las cuentas.';
COMMENT ON COLUMN cuentas.sys_garantia.id IS 'Clave foranea';
COMMENT ON COLUMN cuentas.sys_garantia.classname_id IS 'Clave "foranea via software"  para la garantia indicada por la cuenta.';
COMMENT ON COLUMN cuentas.sys_garantia.tipo IS 'Tipo de garantia que indico el contratista';


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
  CONSTRAINT bb2_otras_cuentas_por_pagar_pkey PRIMARY KEY (id),
  CONSTRAINT fk_garantia_bb2_fk FOREIGN KEY (garantia)
      REFERENCES cuentas.sys_garantia (id) MATCH SIMPLE
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


