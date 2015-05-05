-- Column: contratista_id

-- ALTER TABLE "user" DROP COLUMN contratista_id;

ALTER TABLE "user" ADD COLUMN contratista_id integer;
COMMENT ON COLUMN "user".contratista_id IS 'Clave foránea a la tabla contratista. Indica el vinculo del usuario con la contratista.';


/**************     02/05/2015 *************/




/**************     05/05/2015 *************/

-- Table: cuentas.aa_condiciones_pagos

-- DROP TABLE cuentas.aa_condiciones_pagos;

CREATE TABLE cuentas.aa_condiciones_pagos
(
  id integer NOT NULL DEFAULT nextval('cuentas.aa_condicion_pago_id_seq'::regclass), -- Clave primaria.
  nombre character varying(255) NOT NULL, -- Nombre de la condición de pago.
  "descripción" character varying(255) NOT NULL, -- Descripción detallada de la condición de pago.
  creado_por integer NOT NULL, -- Clave foranea al usuario
  actualizado_por integer NOT NULL, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone, -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT aa_condicion_pago_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.aa_condiciones_pagos
  OWNER TO eureka;
COMMENT ON TABLE cuentas.aa_condiciones_pagos
  IS 'Condiciones de pago.';
COMMENT ON COLUMN cuentas.aa_condiciones_pagos.id IS 'Clave primaria.';
COMMENT ON COLUMN cuentas.aa_condiciones_pagos.nombre IS 'Nombre de la condición de pago.';
COMMENT ON COLUMN cuentas.aa_condiciones_pagos."descripción" IS 'Descripción detallada de la condición de pago.';
COMMENT ON COLUMN cuentas.aa_condiciones_pagos.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.aa_condiciones_pagos.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.aa_condiciones_pagos.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.aa_condiciones_pagos.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.aa_condiciones_pagos.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.aa_condiciones_pagos.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';


-- Table: cuentas.aa_tipos_garantias

-- DROP TABLE cuentas.aa_tipos_garantias;

CREATE TABLE cuentas.aa_tipos_garantias
(
  id integer NOT NULL DEFAULT nextval('cuentas."aa_tipo_garantía_id_seq"'::regclass), -- Clave primaria.
  nombre character varying(255) NOT NULL, -- Nombre del tipo de garantía.
  "descripción" character varying(255) NOT NULL, -- Descripción del tipo de garantía.
  creado_por integer NOT NULL, -- Clave foranea al usuario
  actualizado_por integer NOT NULL, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone, -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT "aa_tipo_garantía_pkey" PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.aa_tipos_garantias
  OWNER TO eureka;
COMMENT ON TABLE cuentas.aa_tipos_garantias
  IS 'Tipo de garantías.';
COMMENT ON COLUMN cuentas.aa_tipos_garantias.id IS 'Clave primaria.';
COMMENT ON COLUMN cuentas.aa_tipos_garantias.nombre IS 'Nombre del tipo de garantía.';
COMMENT ON COLUMN cuentas.aa_tipos_garantias."descripción" IS 'Descripción del tipo de garantía.';
COMMENT ON COLUMN cuentas.aa_tipos_garantias.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.aa_tipos_garantias.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.aa_tipos_garantias.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.aa_tipos_garantias.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.aa_tipos_garantias.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.aa_tipos_garantias.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';

-- Table: cuentas.aa_obligaciones_bancarias

-- DROP TABLE cuentas.aa_obligaciones_bancarias;

CREATE TABLE cuentas.aa_obligaciones_bancarias
(
  id serial NOT NULL, -- Clave primaria
  corriente boolean NOT NULL, -- La obligacion es corriente o no corriente.
  banco_id integer NOT NULL, -- Clave foránea a la tabla bancos
  num_documento character varying(255) NOT NULL, -- Número de documento.
  monto_otorgado numeric(38,6) NOT NULL, -- Monto otorgado.
  fecha_prestamo date NOT NULL, -- Fecha del prestamo.
  fecha_vencimiento date NOT NULL, -- Fecha de vencimiento.
  tasa_interes numeric(38,6) NOT NULL, -- Tasa de interés.
  condicion_pago_id integer NOT NULL, -- Clave foránea a la tabla aa_condiciones_pago
  plazo integer NOT NULL, -- Plazo medido en días.
  tipo_garantia_id integer NOT NULL, -- Clave foránea a la tabla aa_tipos_garantias.
  interes_ejer_econ numeric(38,6) NOT NULL, -- Intereses ejercicio económico.
  interes_pagar numeric(38,6) NOT NULL, -- Interes por pagar.
  importe_deuda numeric(38,6) NOT NULL, -- Importe de la deuda.
  total_imp_deu_int integer NOT NULL, -- Total de importe deuda más intereses. Clave foránea a la tabla sys_totales.
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer NOT NULL, -- Clave foranea al usuario
  actualizado_por integer NOT NULL, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone, -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT aa_obligaciones_bancarias_pkey PRIMARY KEY (id),
  CONSTRAINT aa_obligaciones_bancarias_banco_id_fkey FOREIGN KEY (banco_id)
      REFERENCES sys_bancos (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT aa_obligaciones_bancarias_condicion_pago_id_fkey FOREIGN KEY (condicion_pago_id)
      REFERENCES cuentas.aa_condiciones_pagos (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT aa_obligaciones_bancarias_tipo_garantia_id_fkey FOREIGN KEY (tipo_garantia_id)
      REFERENCES cuentas.aa_tipos_garantias (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT aa_obligaciones_bancarias_total_imp_deu_int_fkey FOREIGN KEY (total_imp_deu_int)
      REFERENCES cuentas.sys_totales (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.aa_obligaciones_bancarias
  OWNER TO eureka;
COMMENT ON TABLE cuentas.aa_obligaciones_bancarias
  IS 'Cuenta AA - Obligaciones Bancarias';
COMMENT ON COLUMN cuentas.aa_obligaciones_bancarias.id IS 'Clave primaria';
COMMENT ON COLUMN cuentas.aa_obligaciones_bancarias.corriente IS 'La obligacion es corriente o no corriente.';
COMMENT ON COLUMN cuentas.aa_obligaciones_bancarias.banco_id IS 'Clave foránea a la tabla bancos';
COMMENT ON COLUMN cuentas.aa_obligaciones_bancarias.num_documento IS 'Número de documento.';
COMMENT ON COLUMN cuentas.aa_obligaciones_bancarias.monto_otorgado IS 'Monto otorgado.';
COMMENT ON COLUMN cuentas.aa_obligaciones_bancarias.fecha_prestamo IS 'Fecha del prestamo.';
COMMENT ON COLUMN cuentas.aa_obligaciones_bancarias.fecha_vencimiento IS 'Fecha de vencimiento.';
COMMENT ON COLUMN cuentas.aa_obligaciones_bancarias.tasa_interes IS 'Tasa de interés.';
COMMENT ON COLUMN cuentas.aa_obligaciones_bancarias.condicion_pago_id IS 'Clave foránea a la tabla aa_condiciones_pago';
COMMENT ON COLUMN cuentas.aa_obligaciones_bancarias.plazo IS 'Plazo medido en días.';
COMMENT ON COLUMN cuentas.aa_obligaciones_bancarias.tipo_garantia_id IS 'Clave foránea a la tabla aa_tipos_garantias.';
COMMENT ON COLUMN cuentas.aa_obligaciones_bancarias.interes_ejer_econ IS 'Intereses ejercicio económico.';
COMMENT ON COLUMN cuentas.aa_obligaciones_bancarias.interes_pagar IS 'Interes por pagar.';
COMMENT ON COLUMN cuentas.aa_obligaciones_bancarias.importe_deuda IS 'Importe de la deuda.';
COMMENT ON COLUMN cuentas.aa_obligaciones_bancarias.total_imp_deu_int IS 'Total de importe deuda más intereses. Clave foránea a la tabla sys_totales.';
COMMENT ON COLUMN cuentas.aa_obligaciones_bancarias.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.aa_obligaciones_bancarias.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.aa_obligaciones_bancarias.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.aa_obligaciones_bancarias.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.aa_obligaciones_bancarias.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.aa_obligaciones_bancarias.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.aa_obligaciones_bancarias.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.aa_obligaciones_bancarias.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';

