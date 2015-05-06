-- Column: contratista_id

-- ALTER TABLE "user" DROP COLUMN contratista_id;

ALTER TABLE "user" ADD COLUMN contratista_id integer;
COMMENT ON COLUMN "user".contratista_id IS 'Clave foránea a la tabla contratista. Indica el vinculo del usuario con la contratista.';


/**************     02/05/2015 *************/

-- Table: cuentas.e_movimientos

-- DROP TABLE cuentas.e_movimientos;

CREATE TABLE cuentas.e_movimientos
(
  id integer NOT NULL DEFAULT nextval('cuentas.sys_movimientos_id_seq'::regclass), -- Clave primaria
  nombre character varying(255) NOT NULL, -- Nombre del tipo de movimiento.
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone, -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT sys_movimientos_pkey PRIMARY KEY (id),
  CONSTRAINT sys_movimientos_nombre_key UNIQUE (nombre)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.e_movimientos
  OWNER TO eureka;
COMMENT ON TABLE cuentas.e_movimientos
  IS 'Contiene los tipos de movimiento de una inversión.';
COMMENT ON COLUMN cuentas.e_movimientos.id IS 'Clave primaria';
COMMENT ON COLUMN cuentas.e_movimientos.nombre IS 'Nombre del tipo de movimiento.';
COMMENT ON COLUMN cuentas.e_movimientos.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.e_movimientos.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.e_movimientos.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.e_movimientos.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.e_movimientos.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.e_movimientos.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';




-- Table: cuentas.e_tipos_movimientos

-- DROP TABLE cuentas.e_tipos_movimientos;

CREATE TABLE cuentas.e_tipos_movimientos
(
  id serial NOT NULL, -- Clave primaria
  e_inversion_id integer NOT NULL, -- Clave foránea a la tabla e_inversiones
  sys_movimiento_id integer NOT NULL, -- Clave foránea a la tabla sys_movimientos.
  fecha date NOT NULL, -- Fecha del tipo de movimiento.
  monto_nominal numeric(38,6) NOT NULL, -- Monto Nominal de Adquisición, Adición o Retiro
  monto_nominal_ajustado numeric(38,6) NOT NULL, -- Monto Nominal de Adquisición, Adición o Retiro (ajustado)
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone, -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT e_tipos_movimientos_pkey PRIMARY KEY (id),
  CONSTRAINT e_tipos_movimientos_e_inversion_id_fkey FOREIGN KEY (e_inversion_id)
      REFERENCES cuentas.e_inversiones (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT e_tipos_movimientos_sys_movimiento_id_fkey FOREIGN KEY (sys_movimiento_id)
      REFERENCES cuentas.e_movimientos (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.e_tipos_movimientos
  OWNER TO eureka;
COMMENT ON TABLE cuentas.e_tipos_movimientos
  IS 'Tabla relación para los tipos de movimiento de una inversión';
COMMENT ON COLUMN cuentas.e_tipos_movimientos.id IS 'Clave primaria';
COMMENT ON COLUMN cuentas.e_tipos_movimientos.e_inversion_id IS 'Clave foránea a la tabla e_inversiones';
COMMENT ON COLUMN cuentas.e_tipos_movimientos.sys_movimiento_id IS 'Clave foránea a la tabla sys_movimientos.';
COMMENT ON COLUMN cuentas.e_tipos_movimientos.fecha IS 'Fecha del tipo de movimiento.';
COMMENT ON COLUMN cuentas.e_tipos_movimientos.monto_nominal IS 'Monto Nominal de Adquisición, Adición o Retiro';
COMMENT ON COLUMN cuentas.e_tipos_movimientos.monto_nominal_ajustado IS 'Monto Nominal de Adquisición, Adición o Retiro (ajustado)';
COMMENT ON COLUMN cuentas.e_tipos_movimientos.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.e_tipos_movimientos.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.e_tipos_movimientos.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.e_tipos_movimientos.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.e_tipos_movimientos.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.e_tipos_movimientos.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';




-- Table: cuentas.e_inversiones_info_adicional

-- DROP TABLE cuentas.e_inversiones_info_adicional;

CREATE TABLE cuentas.e_inversiones_info_adicional
(
  id serial NOT NULL, -- Clave primaria.
  precio_adquisicion numeric(38,6) NOT NULL, -- Precio de Adquisición.
  gan_per numeric(38,6) NOT NULL, -- Ganacia o perdida.
  gan_per_ajustada numeric(38,6) NOT NULL, -- Ganancia o perdida (ajustada).
  prima_descuento boolean NOT NULL, -- Posee prima descuento.
  monto_prima_des numeric(38,6), -- Monto de la prima o descuento, solo si lo tiene.
  plazo integer, -- Plazo Solo para Bonos.
  tasa numeric(38,6), -- Tasa Solo para Bonos.
  cotiza_bolsa_valores boolean NOT NULL, -- Cotiza en la bolsa de valores.
  gtia_oblig_bancaria boolean NOT NULL, -- Es garantía de una olbligación bancaria. Debe vincularse con Obligaciones Bancarias.
  sys_tecnica_medicion_id integer NOT NULL, -- Tecnica de Medición de Costo o Valor Razonable. Si cotiza en la bolsa debe ser el metodo del valor razonable.
  deterioro boolean NOT NULL, -- Aplica deterioro.
  valor_razonable numeric(38,6), -- Valor Razonable. Solo Si es Metodo del Costo.
  costos_disposicion numeric(38,6), -- Costos de disposición. Solo si es Metodo del Costo.
  valor_uso numeric(38,6), -- Valor de uso. Solo Si es Metodo del Costo.
  valor_mercado numeric(38,6), -- Valor del mercado. Solo Si es Metodo del valor razonable.
  deterioro_acumulado numeric(38,6), -- Solo si selecciono que tiene deterioro.
  varia_efecto_infla numeric(38,6), -- Variación por efecto de inflación. Uso del sistema.
  resultado_det_cam_val numeric(38,6), -- Resultado en el Deterioro o Cambio en el Valor. Solo si selecciono 'SI', Calculo según el método.
  sdo_cierre_ejer_econ numeric(38,6), -- Saldo al Cierre del Ejercicio Económico.
  intereses_gen_ejer_econ numeric(38,6), -- Intereses generados durante el Ejercicio Económico.
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone, -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT e_inversiones_info_adicional_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.e_inversiones_info_adicional
  OWNER TO eureka;
COMMENT ON TABLE cuentas.e_inversiones_info_adicional
  IS 'Almacena la información adicional de las inversiones.';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.id IS 'Clave primaria.';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.precio_adquisicion IS 'Precio de Adquisición.';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.gan_per IS 'Ganacia o perdida.';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.gan_per_ajustada IS 'Ganancia o perdida (ajustada).';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.prima_descuento IS 'Posee prima descuento.';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.monto_prima_des IS 'Monto de la prima o descuento, solo si lo tiene.';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.plazo IS 'Plazo Solo para Bonos.';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.tasa IS 'Tasa Solo para Bonos.';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.cotiza_bolsa_valores IS 'Cotiza en la bolsa de valores.';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.gtia_oblig_bancaria IS 'Es garantía de una olbligación bancaria. Debe vincularse con Obligaciones Bancarias.';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.sys_tecnica_medicion_id IS 'Tecnica de Medición de Costo o Valor Razonable. Si cotiza en la bolsa debe ser el metodo del valor razonable.';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.deterioro IS 'Aplica deterioro.';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.valor_razonable IS 'Valor Razonable. Solo Si es Metodo del Costo.';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.costos_disposicion IS 'Costos de disposición. Solo si es Metodo del Costo.';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.valor_uso IS 'Valor de uso. Solo Si es Metodo del Costo.';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.valor_mercado IS 'Valor del mercado. Solo Si es Metodo del valor razonable.';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.deterioro_acumulado IS 'Solo si selecciono que tiene deterioro.';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.varia_efecto_infla IS 'Variación por efecto de inflación. Uso del sistema.';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.resultado_det_cam_val IS 'Resultado en el Deterioro o Cambio en el Valor. Solo si selecciono ''SI'', Calculo según el método.';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.sdo_cierre_ejer_econ IS 'Saldo al Cierre del Ejercicio Económico.
';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.intereses_gen_ejer_econ IS 'Intereses generados durante el Ejercicio Económico.';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.e_inversiones_info_adicional.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';




-- Table: cuentas.e_inversiones

-- DROP TABLE cuentas.e_inversiones;

CREATE TABLE cuentas.e_inversiones
(
  id serial NOT NULL, -- Clave primaria
  empresa_relacionada_id integer NOT NULL, -- Clave foránea a la tabla empresas_relacionadas.
  corriente boolean NOT NULL, -- Indica si es corriente o no corriente.
  disponibilidad tipo_disponibilidad NOT NULL, -- Tipo de disponibilidad de la inversión.
  tipo_instrumento tipo_instrumento NOT NULL, -- Tipo de instrumento.
  nombre_instrumento character varying(255) NOT NULL, -- Nombre del instrumento.
  motivo_retiro tipo_motivo_retiro, -- Motivo de retiro solo en el caso de retiro.
  numero_acc_bon integer NOT NULL, -- Numero de Acciones o bonos
  e_inversion_info_adicional integer NOT NULL, -- Clave foránea a la tabla e_inversiones_info_adicional
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone, -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT e_inversiones_pkey PRIMARY KEY (id),
  CONSTRAINT e_inversiones_e_inversion_info_adicional_fkey FOREIGN KEY (e_inversion_info_adicional)
      REFERENCES cuentas.e_inversiones_info_adicional (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.e_inversiones
  OWNER TO eureka;
COMMENT ON TABLE cuentas.e_inversiones
  IS 'Cuenta E - Inversiones';
COMMENT ON COLUMN cuentas.e_inversiones.id IS 'Clave primaria';
COMMENT ON COLUMN cuentas.e_inversiones.empresa_relacionada_id IS 'Clave foránea a la tabla empresas_relacionadas.';
COMMENT ON COLUMN cuentas.e_inversiones.corriente IS 'Indica si es corriente o no corriente.';
COMMENT ON COLUMN cuentas.e_inversiones.disponibilidad IS 'Tipo de disponibilidad de la inversión.';
COMMENT ON COLUMN cuentas.e_inversiones.tipo_instrumento IS 'Tipo de instrumento.';
COMMENT ON COLUMN cuentas.e_inversiones.nombre_instrumento IS 'Nombre del instrumento.';
COMMENT ON COLUMN cuentas.e_inversiones.motivo_retiro IS 'Motivo de retiro solo en el caso de retiro.';
COMMENT ON COLUMN cuentas.e_inversiones.numero_acc_bon IS 'Numero de Acciones o bonos';
COMMENT ON COLUMN cuentas.e_inversiones.e_inversion_info_adicional IS 'Clave foránea a la tabla e_inversiones_info_adicional';
COMMENT ON COLUMN cuentas.e_inversiones.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.e_inversiones.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.e_inversiones.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.e_inversiones.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.e_inversiones.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.e_inversiones.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.e_inversiones.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.e_inversiones.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';






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

