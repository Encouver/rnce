-- Column: contratista_id

-- ALTER TABLE "user" DROP COLUMN contratista_id;

ALTER TABLE "user" ADD COLUMN contratista_id integer;
COMMENT ON COLUMN "user".contratista_id IS 'Clave foránea a la tabla contratista. Indica el vinculo del usuario con la contratista.';


/**************     02/05/2015 *************/

<<<<<<< HEAD
-- Table: cuentas.e_movimientos

-- DROP TABLE cuentas.e_movimientos;

CREATE TABLE cuentas.e_movimientos
(
  id serial NOT NULL, -- Clave primaria
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



=======
>>>>>>> aafeb2cc82033101854412c952c4abc28466f2fd

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



-- Table: cuentas.e_movimientos

-- DROP TABLE cuentas.e_movimientos;

CREATE TABLE cuentas.e_movimientos
(
  id serial NOT NULL, -- Clave primaria
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












/**************     05/05/2015 *************/

-- Table: cuentas.aa_condiciones_pagos

-- DROP TABLE cuentas.aa_condiciones_pagos;

CREATE TABLE cuentas.aa_condiciones_pagos
(
  id serial NOT NULL, -- Clave primaria
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
  id serial NOT NULL, -- Clave primaria
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



/**************     07/05/2015 *************/

-- Column: costo_avaluo

-- ALTER TABLE activos.depreciaciones_amortizaciones DROP COLUMN costo_avaluo;

ALTER TABLE activos.depreciaciones_amortizaciones ADD COLUMN costo_avaluo numeric(38,6);
COMMENT ON COLUMN activos.depreciaciones_amortizaciones.costo_avaluo IS 'Costo según avaluo.';


ALTER TABLE activos.depreciaciones_amortizaciones
   ALTER COLUMN vida_util DROP NOT NULL;


ALTER TABLE activos.depreciaciones_amortizaciones
   ALTER COLUMN valor_residual DROP NOT NULL;

ALTER TABLE activos.depreciaciones_amortizaciones
   ALTER COLUMN bs_unidad DROP NOT NULL;

ALTER TABLE activos.depreciaciones_amortizaciones
   ALTER COLUMN unidades_estimadas DROP NOT NULL;

   ALTER TABLE activos.depreciaciones_amortizaciones
   ALTER COLUMN tasa_anual DROP NOT NULL;

ALTER TABLE activos.depreciaciones_amortizaciones
   ALTER COLUMN valor_depreciar DROP NOT NULL;

COMMENT ON COLUMN activos.depreciaciones_amortizaciones.valor_residual
  IS 'Valor residual.';

COMMENT ON COLUMN activos.depreciaciones_amortizaciones.valor_depreciar
  IS 'Valor a depreciar.';

COMMENT ON COLUMN activos.depreciaciones_amortizaciones.tasa_anual
  IS 'Tasa anual.';

COMMENT ON COLUMN activos.depreciaciones_amortizaciones.unidades_estimadas
  IS 'Unidades estimadas.';

COMMENT ON COLUMN activos.depreciaciones_amortizaciones.bs_unidad
  IS 'Bs. por unidad.';


ALTER TABLE activos.depreciaciones_amortizaciones
   ALTER COLUMN unidades_producidas_periodo DROP NOT NULL;
COMMENT ON COLUMN activos.depreciaciones_amortizaciones.unidades_producidas_periodo
  IS 'Unidades producidas en el periodo.';

ALTER TABLE activos.depreciaciones_amortizaciones
   ALTER COLUMN unidades_consumidas DROP NOT NULL;
COMMENT ON COLUMN activos.depreciaciones_amortizaciones.unidades_consumidas
  IS 'Unidades consumidas.';

-- Column: directo

-- ALTER TABLE activos.mediciones DROP COLUMN directo;

ALTER TABLE activos.mediciones ADD COLUMN directo boolean;
COMMENT ON COLUMN activos.mediciones.directo IS 'Indica si es directo o indirecto  en tal caso que este vinculado al proceso productivo.';

COMMENT ON TABLE activos.sys_metodos_medicion
  IS 'Lista de metodos de depreciación y amortización.';

-- Column: modelo_id

-- ALTER TABLE activos.sys_metodos_medicion DROP COLUMN modelo_id;

ALTER TABLE activos.sys_metodos_medicion ADD COLUMN modelo_id integer;
ALTER TABLE activos.sys_metodos_medicion ALTER COLUMN modelo_id SET NOT NULL;
COMMENT ON COLUMN activos.sys_metodos_medicion.modelo_id IS 'Clave foránea a la tabla sys_modelos_mediciones. Indica a que modelo pertenece el método o técnica de medición.';


-- Column: clasificacion_id

-- ALTER TABLE activos.sys_metodos_medicion DROP COLUMN clasificacion_id;

ALTER TABLE activos.sys_metodos_medicion ADD COLUMN clasificacion_id integer;
ALTER TABLE activos.sys_metodos_medicion ALTER COLUMN clasificacion_id SET NOT NULL;
COMMENT ON COLUMN activos.sys_metodos_medicion.clasificacion_id IS 'Clave foránea a la tabla sys_clasificaciones_bienes. Indica la clasificación del método o técnica.';

COMMENT ON TABLE activos.sys_metodos_medicion
  IS 'Lista de metodos y técnicas.';


ALTER TABLE activos.sys_modelos_mediciones
  DROP CONSTRAINT sys_modelos_pkey;
ALTER TABLE activos.sys_modelos_mediciones
  ADD PRIMARY KEY (id);
ALTER TABLE activos.sys_modelos_mediciones
  ADD UNIQUE (nombre);



ALTER TABLE activos.sys_metodos_medicion
  ADD FOREIGN KEY (clasificacion_id) REFERENCES activos.sys_clasificaciones_metodos (id) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE activos.sys_metodos_medicion
  ADD FOREIGN KEY (modelo_id) REFERENCES activos.sys_modelos_mediciones (id) ON UPDATE NO ACTION ON DELETE NO ACTION;

COMMENT ON COLUMN activos.deterioros.acumulado_ejer_ant
  IS 'Deterioro acumulado de ejercicios anteriores.';

COMMENT ON COLUMN activos.deterioros.ejercicios_anteriores
  IS 'Ejercicios anteriores. Para el modelo de reavaluación.';

COMMENT ON COLUMN activos.deterioros.valor_uso
  IS 'Valor de uso.';

  ALTER TABLE cuentas.sys_formulas_tecnicas
  DROP CONSTRAINT sys_formulas_tecnicas_tecnica_medicion_id_fkey;
ALTER TABLE cuentas.sys_formulas_tecnicas
  ADD FOREIGN KEY (tecnica_medicion_id) REFERENCES activos.sys_metodos_medicion (id) ON UPDATE NO ACTION ON DELETE NO ACTION;



COMMENT ON COLUMN activos.facturas.comprador_id
  IS 'Clave foranea a la tabla public.sys_naturales_juridicas';
ALTER TABLE activos.facturas
  DROP CONSTRAINT facturas_comprador_id_fkey;
ALTER TABLE activos.facturas
  ADD FOREIGN KEY (comprador_id) REFERENCES sys_naturales_juridicas (id) ON UPDATE NO ACTION ON DELETE NO ACTION;
COMMENT ON COLUMN activos.facturas.comprador_id IS 'Clave foranea a la tabla public.sys_naturales_juridicas';





-- Table: cuentas.mm2_descripciones

-- DROP TABLE cuentas.mm2_descripciones;

CREATE TABLE cuentas.mm2_descripciones
(
  id serial NOT NULL, -- Clave primaria.
  nombre character varying(255), -- Contenido de la descripción.
  descripcion character varying(255), -- Descripción de la descripción.
  CONSTRAINT mm2_descripciones_pkey PRIMARY KEY (id),
  CONSTRAINT mm2_descripciones_nombre_key UNIQUE (nombre)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.mm2_descripciones
  OWNER TO eureka;
COMMENT ON TABLE cuentas.mm2_descripciones
  IS 'Lista de descripciones.';
COMMENT ON COLUMN cuentas.mm2_descripciones.id IS 'Clave primaria.';
COMMENT ON COLUMN cuentas.mm2_descripciones.nombre IS 'Contenido de la descripción.';
COMMENT ON COLUMN cuentas.mm2_descripciones.descripcion IS 'Descripción de la descripción.';



-- Table: cuentas.mm2_tipos_fondos_reservas

-- DROP TABLE cuentas.mm2_tipos_fondos_reservas;

CREATE TABLE cuentas.mm2_tipos_fondos_reservas
(
  id serial NOT NULL, -- Clave primaria.
  nombre character varying(255) NOT NULL, -- Nombre del tipo de fondo y reserva.
  descripcion character varying(255), -- Descripción del tipo de fondo y reserva.
  CONSTRAINT mm2_tipos_fondos_reservas_pkey PRIMARY KEY (id),
  CONSTRAINT mm2_tipos_fondos_reservas_nombre_key UNIQUE (nombre)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.mm2_tipos_fondos_reservas
  OWNER TO eureka;
COMMENT ON TABLE cuentas.mm2_tipos_fondos_reservas
  IS 'Lista de los tipos de Fondos y Reservas.';
COMMENT ON COLUMN cuentas.mm2_tipos_fondos_reservas.id IS 'Clave primaria.';
COMMENT ON COLUMN cuentas.mm2_tipos_fondos_reservas.nombre IS 'Nombre del tipo de fondo y reserva.';
COMMENT ON COLUMN cuentas.mm2_tipos_fondos_reservas.descripcion IS 'Descripción del tipo de fondo y reserva.';








CREATE TABLE cuentas.mm2_fondos_reservas
(
   id serial NOT NULL, 
   tipo_fondo_reserva_id integer NOT NULL, 
   saldo_inicial_ejercicio numeric(38,6) NOT NULL, 
   saldo_ajuscierre_ejercicio numeric(38,6) NOT NULL, 
   descripcion_id integer NOT NULL, 
   detalle character varying(255) NOT NULL, 
   fecha_uso date, 
   monto numeric(38,6) NOT NULL, 
   monto_ajustado numeric(38,6) NOT NULL, 
   reservas boolean NOT NULL, 
   descripcion_apartado_id integer, 
   ingreso_ejercicio numeric(38,6) NOT NULL, 
   porcentaje_aplicado numeric(38,6) NOT NULL, 
   monto_apartados numeric(38,6) NOT NULL, 
   saldo_cierre_ejercicio numeric(38,6) NOT NULL, 
   PRIMARY KEY (id), 
   FOREIGN KEY (tipo_fondo_reserva_id) REFERENCES cuentas.mm2_tipos_fondos_reservas (id) ON UPDATE NO ACTION ON DELETE NO ACTION, 
   FOREIGN KEY (descripcion_apartado_id) REFERENCES cuentas.mm2_descripciones (id) ON UPDATE NO ACTION ON DELETE NO ACTION, 
   FOREIGN KEY (descripcion_id) REFERENCES cuentas.mm2_descripciones (id) ON UPDATE NO ACTION ON DELETE NO ACTION
) 
WITH (
  OIDS = FALSE
)
;
ALTER TABLE cuentas.mm2_fondos_reservas
  OWNER TO eureka;
COMMENT ON COLUMN cuentas.mm2_fondos_reservas.id IS 'Clave primaria.';
COMMENT ON COLUMN cuentas.mm2_fondos_reservas.tipo_fondo_reserva_id IS 'Clave foránea a la tabla tipos_fondos_reservas. ';
COMMENT ON COLUMN cuentas.mm2_fondos_reservas.saldo_inicial_ejercicio IS 'Saldo inicial del ejercicio económico.';
COMMENT ON COLUMN cuentas.mm2_fondos_reservas.saldo_ajuscierre_ejercicio IS 'Saldo ajustado al cierre del ejercicio económico.';
COMMENT ON COLUMN cuentas.mm2_fondos_reservas.descripcion_id IS 'Clave foránea a la tabla mm2_descripciones.';
COMMENT ON COLUMN cuentas.mm2_fondos_reservas.detalle IS 'Detalle.';
COMMENT ON COLUMN cuentas.mm2_fondos_reservas.fecha_uso IS 'Fecha de uso (No aplica para ajustes).';
COMMENT ON COLUMN cuentas.mm2_fondos_reservas.monto IS 'Monto.';
COMMENT ON COLUMN cuentas.mm2_fondos_reservas.monto_ajustado IS 'Monto Ajustado.';
COMMENT ON COLUMN cuentas.mm2_fondos_reservas.reservas IS 'Genero reservas durante el periodo.';
COMMENT ON COLUMN cuentas.mm2_fondos_reservas.descripcion_apartado_id IS 'Clave foránea a la tabla mm2_descripciones.';
COMMENT ON COLUMN cuentas.mm2_fondos_reservas.ingreso_ejercicio IS 'Ingreso del Ejercicio.';
COMMENT ON COLUMN cuentas.mm2_fondos_reservas.porcentaje_aplicado IS 'Porcentaje aplicado.';
COMMENT ON COLUMN cuentas.mm2_fondos_reservas.monto_apartados IS 'Monto de apartados durante el ejercicio.';
COMMENT ON COLUMN cuentas.mm2_fondos_reservas.saldo_cierre_ejercicio IS 'Saldo al cierre del ejercicio económico.';
COMMENT ON TABLE cuentas.mm2_fondos_reservas
  IS 'Cuenta MM2 - Fondos y Reservas';



  CREATE TABLE cuentas.mm1_ajustes_correciones_revals
(
   id serial NOT NULL, 
   nombre character varying(255) NOT NULL, 
   descripcion character varying(255), 
   PRIMARY KEY (id), 
   UNIQUE (nombre)
) 
WITH (
  OIDS = FALSE
)
;
ALTER TABLE cuentas.mm1_ajustes_correciones_revals
  OWNER TO eureka;
COMMENT ON COLUMN cuentas.mm1_ajustes_correciones_revals.id IS 'Clave primaria.';
COMMENT ON COLUMN cuentas.mm1_ajustes_correciones_revals.nombre IS 'Nombre del Ajuste / Correccion / Revalorizacion.';
COMMENT ON COLUMN cuentas.mm1_ajustes_correciones_revals.descripcion IS 'Descripcion del Ajuste / Correccion / Revalorizacion.';
COMMENT ON TABLE cuentas.mm1_ajustes_correciones_revals
  IS 'Lista de Ajustes / Correcciones / Revalorizaciones';









-- Table: cuentas.mm1_resacum_ajus_correc

-- DROP TABLE cuentas.mm1_resacum_ajus_correc;

CREATE TABLE cuentas.mm1_resacum_ajus_correc
(
  id serial NOT NULL, -- Clave primaria.
  resultado_acumulado_id integer NOT NULL, -- Clave foránea a la tabla mm1_resultados_acumulados.
  ajuste_corre_reval_id integer NOT NULL, -- Clave foránea a la tabla mm1_ajustes_correciones_revals.
  CONSTRAINT mm1_resacum_ajus_correc_pkey PRIMARY KEY (id),
  CONSTRAINT mm1_resacum_ajus_correc_ajuste_corre_reval_id_fkey FOREIGN KEY (ajuste_corre_reval_id)
      REFERENCES cuentas.mm1_ajustes_correciones_revals (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT mm1_resacum_ajus_correc_resultado_acumulado_id_fkey FOREIGN KEY (resultado_acumulado_id)
      REFERENCES cuentas.mm1_resultados_acumulados (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.mm1_resacum_ajus_correc
  OWNER TO eureka;
COMMENT ON TABLE cuentas.mm1_resacum_ajus_correc
  IS 'Lista de ajuste correciones y revalorizaciones.';
COMMENT ON COLUMN cuentas.mm1_resacum_ajus_correc.id IS 'Clave primaria.';
COMMENT ON COLUMN cuentas.mm1_resacum_ajus_correc.resultado_acumulado_id IS 'Clave foránea a la tabla mm1_resultados_acumulados.';
COMMENT ON COLUMN cuentas.mm1_resacum_ajus_correc.ajuste_corre_reval_id IS 'Clave foránea a la tabla mm1_ajustes_correciones_revals.';



-- Table: cuentas.mm1_resultados_acumulados

-- DROP TABLE cuentas.mm1_resultados_acumulados;

CREATE TABLE cuentas.mm1_resultados_acumulados
(
  id serial NOT NULL, -- Clave primaria.
  saldo_inicio_ejercicio numeric(38,6) NOT NULL, -- Saldo al Inicio del Ejercicio Económico.
  saldo_ajuscierre_ejercicio numeric(38,6) NOT NULL, -- Saldo ajustado al cierre del ejercicio económico.
  ajustes_correcciones_reval boolean NOT NULL, -- Pregunta: Se Aplicaron Ajustes / Correcciones / Revalorizaciones? No. (NO se carga) Si.  (Activar Lista Desplegable)
  fecha_inicio date NOT NULL, -- Fecha (INICIO)
  monto_aum_dis numeric(38,6) NOT NULL, -- Monto de aumentos y disminuciones.
  monto_ajustado_aum_dis numeric(38,6) NOT NULL, -- Monto Ajustado aumentos y disminuciones.
  total_ajustes_correciones numeric(38,6) NOT NULL, -- Total de Ajustes/Correciones.
  monto_historico numeric(38,6) NOT NULL, -- Monto Histórico.
  monto_ajustado_gan_per numeric(38,6) NOT NULL, -- Monto Ajustado Ganancia o Pérdida del Ejercicio.
  saldo_cierre_ejercicio numeric(38,6) NOT NULL, -- Saldo al cierre del ejercicio económico.
  CONSTRAINT mm1_resultados_acumulados_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.mm1_resultados_acumulados
  OWNER TO eureka;
COMMENT ON TABLE cuentas.mm1_resultados_acumulados
  IS 'Cuenta MM1 - Resultados Acumulados.';
COMMENT ON COLUMN cuentas.mm1_resultados_acumulados.id IS 'Clave primaria.';
COMMENT ON COLUMN cuentas.mm1_resultados_acumulados.saldo_inicio_ejercicio IS 'Saldo al Inicio del Ejercicio Económico.';
COMMENT ON COLUMN cuentas.mm1_resultados_acumulados.saldo_ajuscierre_ejercicio IS 'Saldo ajustado al cierre del ejercicio económico.';
COMMENT ON COLUMN cuentas.mm1_resultados_acumulados.ajustes_correcciones_reval IS 'Pregunta: Se Aplicaron Ajustes / Correcciones / Revalorizaciones? No. (NO se carga) Si.  (Activar Lista Desplegable)';
COMMENT ON COLUMN cuentas.mm1_resultados_acumulados.fecha_inicio IS 'Fecha (INICIO)';
COMMENT ON COLUMN cuentas.mm1_resultados_acumulados.monto_aum_dis IS 'Monto de aumentos y disminuciones.';
COMMENT ON COLUMN cuentas.mm1_resultados_acumulados.monto_ajustado_aum_dis IS 'Monto Ajustado aumentos y disminuciones.';
COMMENT ON COLUMN cuentas.mm1_resultados_acumulados.total_ajustes_correciones IS 'Total de Ajustes/Correciones.';
COMMENT ON COLUMN cuentas.mm1_resultados_acumulados.monto_historico IS 'Monto Histórico.';
COMMENT ON COLUMN cuentas.mm1_resultados_acumulados.monto_ajustado_gan_per IS 'Monto Ajustado Ganancia o Pérdida del Ejercicio.';
COMMENT ON COLUMN cuentas.mm1_resultados_acumulados.saldo_cierre_ejercicio IS 'Saldo al cierre del ejercicio económico.';




/**************     11/05/2015 *************/


ALTER TABLE cuentas.sys_totales RENAME ahno  TO anho;

ALTER TABLE cuentas.aa_obligaciones_bancarias
ALTER COLUMN total_imp_deu_int DROP NOT NULL;



/**************     14/05/2015 *************/

ALTER TABLE activos.bienes
ADD FOREIGN KEY (sys_tipo_bien_id) REFERENCES activos.sys_tipos_bienes (id) ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE activos.activos_biologicos RENAME catidad  TO cantidad;

ALTER TABLE activos.fabricaciones_muebles
ADD COLUMN tipo_bien_id integer NOT NULL;
COMMENT ON COLUMN activos.fabricaciones_muebles.tipo_bien_id
IS 'Tipo de bien mueble que esta fabricando.';

