-- Table: cuentas.sys_totales

-- DROP TABLE cuentas.sys_totales;

CREATE TABLE cuentas.sys_totales
(
  id serial NOT NULL, -- Clave primaria
  classname character varying(200) NOT NULL, -- Nombre de la tabla a donde pertenecen los totales
  valor character varying(255) NOT NULL, -- Valores separados por : que indican la cantidad de los totales
  id_classname integer NOT NULL, -- Clave "foranea" a la tabla referenciada por classname
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone, -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  total boolean DEFAULT false, -- si el valor pertenece a un total
  CONSTRAINT sys_totales_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.sys_totales
  OWNER TO eureka;
COMMENT ON TABLE cuentas.sys_totales
  IS 'Tabla donde se almanecaran los totales de todas las cuentas';
COMMENT ON COLUMN cuentas.sys_totales.id IS 'Clave primaria';
COMMENT ON COLUMN cuentas.sys_totales.classname IS 'Nombre de la tabla a donde pertenecen los totales';
COMMENT ON COLUMN cuentas.sys_totales.valor IS 'Valores separados por : que indican la cantidad de los totales';
COMMENT ON COLUMN cuentas.sys_totales.id_classname IS 'Clave "foranea" a la tabla referenciada por classname';
COMMENT ON COLUMN cuentas.sys_totales.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.sys_totales.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.sys_totales.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.sys_totales.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';
COMMENT ON COLUMN cuentas.sys_totales.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.sys_totales.total IS 'si el valor pertenece a un total';



ALTER TABLE cuentas.sys_totales ADD COLUMN ahno character varying(100);
ALTER TABLE cuentas.sys_totales ALTER COLUMN ahno SET NOT NULL;
COMMENT ON COLUMN cuentas.sys_totales.ahno IS 'Año y mes del cierre contable';

-- Table: cuentas.a_efectivos_bancos

-- DROP TABLE cuentas.a_efectivos_bancos;

CREATE TABLE cuentas.a_efectivos_bancos
(
  id serial NOT NULL, -- Clave foranea
  banco_contratista_id integer NOT NULL, -- Clave foranea a la tabla
  saldo_segun_b numeric(38,6), -- Saldo segun banco
  nd_no_cont numeric(38,6) NOT NULL, -- nd_no_contabilizadas
  depo_transito numeric(38,6) NOT NULL, -- Depositos en transito
  nc_no_cont numeric(38,6) NOT NULL, -- Nc no contabilizadas
  cheques_transito numeric(38,6) NOT NULL, -- Cheques en transito
  saldo_al_cierre numeric(38,6) NOT NULL, -- Saldo al cierre del ejercicio
  intereses_act_eco numeric(38,6) NOT NULL, -- Intereses generado duracte la actividad economica
  tipo_moneda_id integer, -- Clave foranea public.sys_divisas
  monto_moneda_extra numeric(38,6), -- Monto en moneda extranjera
  tipo_cambio_cierre numeric(38,6), -- Tipo de cambio al cierre
  creado_por integer, -- Clave foranea a la tabla usuarios
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone, -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  contratista_id integer, -- Clave foranea al contratista
  anho character varying(100), -- Año contable y mes
  total_id integer NOT NULL, -- Clave foranea a la tabla sys_totales
  CONSTRAINT a_efectivos_bancos_pkey PRIMARY KEY (id),
  CONSTRAINT fk_bancos_cuentas_a FOREIGN KEY (banco_contratista_id)
      REFERENCES bancos_contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fk_contratistas FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fk_moneda_divisa_a_bancos FOREIGN KEY (tipo_moneda_id)
      REFERENCES sys_divisas (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fk_totales_cuenta_a_bancos FOREIGN KEY (total_id)
      REFERENCES cuentas.sys_totales (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fk_usuario_cuenta_a FOREIGN KEY (creado_por)
      REFERENCES "user" (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.a_efectivos_bancos
  OWNER TO eureka;
COMMENT ON TABLE cuentas.a_efectivos_bancos
  IS 'Tabla que almacena el efectivo de los bancos de los contratistas';
COMMENT ON COLUMN cuentas.a_efectivos_bancos.id IS 'Clave foranea';
COMMENT ON COLUMN cuentas.a_efectivos_bancos.banco_contratista_id IS 'Clave foranea a la tabla ';
COMMENT ON COLUMN cuentas.a_efectivos_bancos.saldo_segun_b IS 'Saldo segun banco';
COMMENT ON COLUMN cuentas.a_efectivos_bancos.nd_no_cont IS 'nd_no_contabilizadas';
COMMENT ON COLUMN cuentas.a_efectivos_bancos.depo_transito IS 'Depositos en transito';
COMMENT ON COLUMN cuentas.a_efectivos_bancos.nc_no_cont IS 'Nc no contabilizadas';
COMMENT ON COLUMN cuentas.a_efectivos_bancos.cheques_transito IS 'Cheques en transito';
COMMENT ON COLUMN cuentas.a_efectivos_bancos.saldo_al_cierre IS 'Saldo al cierre del ejercicio';
COMMENT ON COLUMN cuentas.a_efectivos_bancos.intereses_act_eco IS 'Intereses generado duracte la actividad economica';
COMMENT ON COLUMN cuentas.a_efectivos_bancos.tipo_moneda_id IS 'Clave foranea public.sys_divisas';
COMMENT ON COLUMN cuentas.a_efectivos_bancos.monto_moneda_extra IS 'Monto en moneda extranjera';
COMMENT ON COLUMN cuentas.a_efectivos_bancos.tipo_cambio_cierre IS 'Tipo de cambio al cierre';
COMMENT ON COLUMN cuentas.a_efectivos_bancos.creado_por IS 'Clave foranea a la tabla usuarios';
COMMENT ON COLUMN cuentas.a_efectivos_bancos.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.a_efectivos_bancos.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.a_efectivos_bancos.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.a_efectivos_bancos.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';
COMMENT ON COLUMN cuentas.a_efectivos_bancos.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.a_efectivos_bancos.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.a_efectivos_bancos.total_id IS 'Clave foranea a la tabla sys_totales';


-- Index: cuentas.fki_bancos_cuentas_a

-- DROP INDEX cuentas.fki_bancos_cuentas_a;

CREATE INDEX fki_bancos_cuentas_a
  ON cuentas.a_efectivos_bancos
  USING btree
  (banco_contratista_id);

-- Index: cuentas.fki_contratistas

-- DROP INDEX cuentas.fki_contratistas;

CREATE INDEX fki_contratistas
  ON cuentas.a_efectivos_bancos
  USING btree
  (contratista_id);

-- Index: cuentas.fki_moneda_divisa_a_bancos

-- DROP INDEX cuentas.fki_moneda_divisa_a_bancos;

CREATE INDEX fki_moneda_divisa_a_bancos
  ON cuentas.a_efectivos_bancos
  USING btree
  (tipo_moneda_id);

-- Index: cuentas.fki_totales_cuenta_a_bancos

-- DROP INDEX cuentas.fki_totales_cuenta_a_bancos;

CREATE INDEX fki_totales_cuenta_a_bancos
  ON cuentas.a_efectivos_bancos
  USING btree
  (total_id);

-- Index: cuentas.fki_usuario_cuenta_a

-- DROP INDEX cuentas.fki_usuario_cuenta_a;

CREATE INDEX fki_usuario_cuenta_a
  ON cuentas.a_efectivos_bancos
  USING btree
  (creado_por);


  -- Table: cuentas.a_efectivos_cajas

-- DROP TABLE cuentas.a_efectivos_cajas;

CREATE TABLE cuentas.a_efectivos_cajas
(
  id serial NOT NULL, -- Clave foranea
  nombre_caja_id integer, -- Clave foranea a la tabla public.nombres_cajas
  saldo_cierre_ae numeric(38,6) NOT NULL, -- Saldo al cierre de la actividad economica
  tipo_moneda_id integer, -- Clave foranea a la tabla public.sys_divisas
  monto_me numeric(38,6),
  tipo_cambio_cierre numeric(38,6), -- Tipo de cambio al cierre
  nacional boolean DEFAULT true, -- indica si la cuenta es nacional o no.
  total_id integer NOT NULL, -- Clave foranea a la tabla cuentas.sys_totales
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone, -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  contratista_id integer, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea a la tabla usuarios
  CONSTRAINT a_efectivo_caja_pkey PRIMARY KEY (id),
  CONSTRAINT fk_contratista_cuenta_a FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fk_moneda_divisa FOREIGN KEY (tipo_moneda_id)
      REFERENCES sys_divisas (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fk_nombre_caja FOREIGN KEY (nombre_caja_id)
      REFERENCES nombres_cajas (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fk_usuarios_a_cuenta FOREIGN KEY (creado_por)
      REFERENCES "user" (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.a_efectivos_cajas
  OWNER TO eureka;
COMMENT ON TABLE cuentas.a_efectivos_cajas
  IS 'Cuenta A-Efectivo y sus equivalentes';
COMMENT ON COLUMN cuentas.a_efectivos_cajas.id IS 'Clave foranea';
COMMENT ON COLUMN cuentas.a_efectivos_cajas.nombre_caja_id IS 'Clave foranea a la tabla public.nombres_cajas';
COMMENT ON COLUMN cuentas.a_efectivos_cajas.saldo_cierre_ae IS 'Saldo al cierre de la actividad economica';
COMMENT ON COLUMN cuentas.a_efectivos_cajas.tipo_moneda_id IS 'Clave foranea a la tabla public.sys_divisas';
COMMENT ON COLUMN cuentas.a_efectivos_cajas.tipo_cambio_cierre IS 'Tipo de cambio al cierre';
COMMENT ON COLUMN cuentas.a_efectivos_cajas.nacional IS 'indica si la cuenta es nacional o no.';
COMMENT ON COLUMN cuentas.a_efectivos_cajas.total_id IS 'Clave foranea a la tabla cuentas.sys_totales';
COMMENT ON COLUMN cuentas.a_efectivos_cajas.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.a_efectivos_cajas.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.a_efectivos_cajas.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.a_efectivos_cajas.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';
COMMENT ON COLUMN cuentas.a_efectivos_cajas.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.a_efectivos_cajas.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.a_efectivos_cajas.creado_por IS 'Clave foranea a la tabla usuarios';


-- Index: cuentas.fki_contratista_cuenta_a

-- DROP INDEX cuentas.fki_contratista_cuenta_a;

CREATE INDEX fki_contratista_cuenta_a
  ON cuentas.a_efectivos_cajas
  USING btree
  (contratista_id);

-- Index: cuentas.fki_moneda_divisa

-- DROP INDEX cuentas.fki_moneda_divisa;

CREATE INDEX fki_moneda_divisa
  ON cuentas.a_efectivos_cajas
  USING btree
  (tipo_moneda_id);

-- Index: cuentas.fki_nombre_caja

-- DROP INDEX cuentas.fki_nombre_caja;

CREATE INDEX fki_nombre_caja
  ON cuentas.a_efectivos_cajas
  USING btree
  (nombre_caja_id);

-- Index: cuentas.fki_usuarios_a_cuenta

-- DROP INDEX cuentas.fki_usuarios_a_cuenta;

CREATE INDEX fki_usuarios_a_cuenta
  ON cuentas.a_efectivos_cajas
  USING btree
  (creado_por);


-- Table: cuentas.a_inversiones_negociar

-- DROP TABLE cuentas.a_inversiones_negociar;

CREATE TABLE cuentas.a_inversiones_negociar
(
  id serial NOT NULL, -- Clave primaria
  banco_id integer NOT NULL, -- Clave foranea a la tabla banco de los contratistas
  fecha_inversion date NOT NULL, -- Fecha de la inversion
  fecha_finalizacion date NOT NULL, -- Fecha de finalizacion
  tasa numeric(38,6) NOT NULL, -- Tasa de inversion
  plazo integer NOT NULL, -- Plazo de la inversion
  costo_adquisicion numeric(38,6) NOT NULL, -- Costo de la adquisicion
  valorizacion numeric(38,6) NOT NULL,
  saldo_al_cierre numeric(38,6) NOT NULL, -- Saldo al cierre fiscal
  intereses_act_eco numeric(38,6) NOT NULL, -- Intereses generados durante la actividad economica
  tipo_moneda_id integer NOT NULL, -- Clave foranea a la tabla sys_divisas
  monto_moneda_extra numeric(38,6), -- Monto en moneda extranjera
  tipo_cambio_cierre numeric(38,6), -- Tipo de cambio al cierre
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone, -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  contratista_id integer, -- Clave foranea al contratista
  anho character varying(100), -- Año contable y mes
  creado_por integer, -- Clave foranea a la tabla usuarios
  total_id integer NOT NULL, -- Clave foranea a la tabla sys_totales
  CONSTRAINT a_inversiones_negociar_pkey PRIMARY KEY (id),
  CONSTRAINT fk_banco_cuenta FOREIGN KEY (banco_id)
      REFERENCES bancos_contratistas (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fk_banco_divisa FOREIGN KEY (tipo_moneda_id)
      REFERENCES sys_divisas (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fk_inversiones_contrati FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fk_sys_totales_cuenta_a FOREIGN KEY (total_id)
      REFERENCES cuentas.sys_totales (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fk_usuario_inversiones FOREIGN KEY (creado_por)
      REFERENCES "user" (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.a_inversiones_negociar
  OWNER TO eureka;
COMMENT ON TABLE cuentas.a_inversiones_negociar
  IS 'Tabla que almacena las inversiones a negociar de los contratistas';
COMMENT ON COLUMN cuentas.a_inversiones_negociar.id IS 'Clave primaria';
COMMENT ON COLUMN cuentas.a_inversiones_negociar.banco_id IS 'Clave foranea a la tabla banco de los contratistas';
COMMENT ON COLUMN cuentas.a_inversiones_negociar.fecha_inversion IS 'Fecha de la inversion';
COMMENT ON COLUMN cuentas.a_inversiones_negociar.fecha_finalizacion IS 'Fecha de finalizacion';
COMMENT ON COLUMN cuentas.a_inversiones_negociar.tasa IS 'Tasa de inversion';
COMMENT ON COLUMN cuentas.a_inversiones_negociar.plazo IS 'Plazo de la inversion';
COMMENT ON COLUMN cuentas.a_inversiones_negociar.costo_adquisicion IS 'Costo de la adquisicion';
COMMENT ON COLUMN cuentas.a_inversiones_negociar.saldo_al_cierre IS 'Saldo al cierre fiscal';
COMMENT ON COLUMN cuentas.a_inversiones_negociar.intereses_act_eco IS 'Intereses generados durante la actividad economica';
COMMENT ON COLUMN cuentas.a_inversiones_negociar.tipo_moneda_id IS 'Clave foranea a la tabla sys_divisas';
COMMENT ON COLUMN cuentas.a_inversiones_negociar.monto_moneda_extra IS 'Monto en moneda extranjera';
COMMENT ON COLUMN cuentas.a_inversiones_negociar.tipo_cambio_cierre IS 'Tipo de cambio al cierre';
COMMENT ON COLUMN cuentas.a_inversiones_negociar.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.a_inversiones_negociar.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.a_inversiones_negociar.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.a_inversiones_negociar.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';
COMMENT ON COLUMN cuentas.a_inversiones_negociar.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.a_inversiones_negociar.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.a_inversiones_negociar.creado_por IS 'Clave foranea a la tabla usuarios';
COMMENT ON COLUMN cuentas.a_inversiones_negociar.total_id IS 'Clave foranea a la tabla sys_totales';


-- Index: cuentas.fki_banco_cuenta

-- DROP INDEX cuentas.fki_banco_cuenta;

CREATE INDEX fki_banco_cuenta
  ON cuentas.a_inversiones_negociar
  USING btree
  (banco_id);

-- Index: cuentas.fki_banco_divisa

-- DROP INDEX cuentas.fki_banco_divisa;

CREATE INDEX fki_banco_divisa
  ON cuentas.a_inversiones_negociar
  USING btree
  (tipo_moneda_id);

-- Index: cuentas.fki_inversiones_contrati

-- DROP INDEX cuentas.fki_inversiones_contrati;

CREATE INDEX fki_inversiones_contrati
  ON cuentas.a_inversiones_negociar
  USING btree
  (contratista_id);

-- Index: cuentas.fki_sys_totales_cuenta_a

-- DROP INDEX cuentas.fki_sys_totales_cuenta_a;

CREATE INDEX fki_sys_totales_cuenta_a
  ON cuentas.a_inversiones_negociar
  USING btree
  (total_id);

-- Index: cuentas.fki_usuario_inversiones

-- DROP INDEX cuentas.fki_usuario_inversiones;

CREATE INDEX fki_usuario_inversiones
  ON cuentas.a_inversiones_negociar
  USING btree
  (creado_por);

  
  
---------10/05/2015-----------

ALTER TABLE cuentas.a_inversiones_negociar ADD COLUMN nacional boolean;
ALTER TABLE cuentas.a_inversiones_negociar ALTER COLUMN nacional SET DEFAULT true;
COMMENT ON COLUMN cuentas.a_inversiones_negociar.nacional IS 'indica si la cuenta es nacional o no';


ALTER TABLE cuentas.a_efectivos_bancos ADD COLUMN nacional boolean;
ALTER TABLE cuentas.a_efectivos_bancos ALTER COLUMN nacional SET DEFAULT true;
COMMENT ON COLUMN cuentas.a_efectivos_bancos.nacional IS 'indica si la cuenta es nacional o no';


ALTER TABLE sys_bancos DROP COLUMN tipo_nacionalidad;

ALTER TABLE sys_bancos ADD COLUMN nacional boolean;
ALTER TABLE sys_bancos ALTER COLUMN nacional SET DEFAULT true;
COMMENT ON COLUMN sys_bancos.nacional IS 'Indica si la cuenta es nacional o no';


-------------------15/05/2015---------------------------

ALTER TABLE nombres_cajas DROP COLUMN tipo_caja;

ALTER TABLE nombres_cajas ADD COLUMN nacional boolean;
ALTER TABLE nombres_cajas ALTER COLUMN nacional SET NOT NULL;
ALTER TABLE nombres_cajas ALTER COLUMN nacional SET DEFAULT true;
COMMENT ON COLUMN nombres_cajas.nacional IS 'Indica si la caja es para moneda nacional o extranjera';

ALTER TABLE nombres_cajas ADD COLUMN tipo_caja character varying(255);
ALTER TABLE nombres_cajas ALTER COLUMN tipo_caja SET NOT NULL;
COMMENT ON COLUMN nombres_cajas.tipo_caja IS 'Campo que indica si la caja es Caja o Caja chica';

ALTER TABLE cuentas.a_efectivos_bancos ALTER COLUMN total_id DROP NOT NULL;
ALTER TABLE cuentas.a_efectivos_cajas ALTER COLUMN total_id DROP NOT NULL;
ALTER TABLE cuentas.a_inversiones_negociar ALTER COLUMN total_id DROP NOT NULL;

-- MARCOS


-------------------------18/05/2015-------------------------------

ALTER TABLE cierres_ejercicios
  DROP COLUMN fecha_cierre;
ALTER TABLE cierres_ejercicios
  ADD COLUMN fecha_cierre character varying(100);
COMMENT ON COLUMN cierres_ejercicios.fecha_cierre IS 'Fecha en formato año y mes del ejercicio economico del contratista';


---------------Mas nuevo del mismo 18-------------------------------

-- Table: cuentas.d1_d2_beneficiario

-- DROP TABLE cuentas.d1_d2_beneficiario;

CREATE TABLE cuentas.d1_d2_beneficiario
(
  id serial NOT NULL, -- Clave primaria
  nro_planilla character varying(255) NOT NULL, -- Numero de planilla
  periodo character varying(200) NOT NULL,
  monto numeric(38,6) NOT NULL, -- Monto cedido en el ejercicio economico
  sys_naturales_juridicas_id integer NOT NULL, -- Clave foranea a la tabla sys_naturales_juridicas
  tipo_beneficio character varying(255) NOT NULL, -- Campo que indica si el registro viene de la cuenta d-1 o d-2
  CONSTRAINT d1_beneficierio_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.d1_d2_beneficiario
  OWNER TO eureka;
COMMENT ON TABLE cuentas.d1_d2_beneficiario
  IS 'Tabla intermedia de la cuenta D-1 y D-2 que almacena el beneficiario del importe cedido';
COMMENT ON COLUMN cuentas.d1_d2_beneficiario.id IS 'Clave primaria';
COMMENT ON COLUMN cuentas.d1_d2_beneficiario.nro_planilla IS 'Numero de planilla';
COMMENT ON COLUMN cuentas.d1_d2_beneficiario.monto IS 'Monto cedido en el ejercicio economico';
COMMENT ON COLUMN cuentas.d1_d2_beneficiario.sys_naturales_juridicas_id IS 'Clave foranea a la tabla sys_naturales_juridicas';
COMMENT ON COLUMN cuentas.d1_d2_beneficiario.tipo_beneficio IS 'Campo que indica si el registro viene de la cuenta d-1 o d-2';


-- Table: cuentas.d1_islr_pagado_anticipo

-- DROP TABLE cuentas.d1_islr_pagado_anticipo;

CREATE TABLE cuentas.d1_islr_pagado_anticipo
(
  id serial NOT NULL, -- Clave primaria
  isrl_pagado character varying(255) NOT NULL, -- Islr pagado por anticipado
  nro_documento character varying, -- Numero de documento del islr
  saldo_ph numeric(38,6) NOT NULL, -- Saldo del periodo anterior Historico
  importe_pagado_ejer_econo numeric(38,6) NOT NULL, -- Importe pagado en el ejercicio economico
  importe_aplicado_ejer_econo numeric(38,6) NOT NULL, -- Importe aplicado en el ejercicio economico
  saldo_cierre numeric(38,6), -- Saldo al cierre del ejercicio economico.
  monto numeric(38,6), -- Monto del importe cedido en el ejercicio economico
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT d1_islr_pagado_anticipo_pkey PRIMARY KEY (id),
  CONSTRAINT d1_islr_pagado_anticipo_contratista_id_fkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.d1_islr_pagado_anticipo
  OWNER TO eureka;
COMMENT ON TABLE cuentas.d1_islr_pagado_anticipo
  IS 'Tabla que almacena el islr pagado por anticipado';
COMMENT ON COLUMN cuentas.d1_islr_pagado_anticipo.id IS 'Clave primaria';
COMMENT ON COLUMN cuentas.d1_islr_pagado_anticipo.isrl_pagado IS 'Islr pagado por anticipado';
COMMENT ON COLUMN cuentas.d1_islr_pagado_anticipo.nro_documento IS 'Numero de documento del islr';
COMMENT ON COLUMN cuentas.d1_islr_pagado_anticipo.saldo_ph IS 'Saldo del periodo anterior Historico';
COMMENT ON COLUMN cuentas.d1_islr_pagado_anticipo.importe_pagado_ejer_econo IS 'Importe pagado en el ejercicio economico';
COMMENT ON COLUMN cuentas.d1_islr_pagado_anticipo.importe_aplicado_ejer_econo IS 'Importe aplicado en el ejercicio economico';
COMMENT ON COLUMN cuentas.d1_islr_pagado_anticipo.saldo_cierre IS 'Saldo al cierre del ejercicio economico.';
COMMENT ON COLUMN cuentas.d1_islr_pagado_anticipo.monto IS 'Monto del importe cedido en el ejercicio economico';
COMMENT ON COLUMN cuentas.d1_islr_pagado_anticipo.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.d1_islr_pagado_anticipo.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.d1_islr_pagado_anticipo.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.d1_islr_pagado_anticipo.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.d1_islr_pagado_anticipo.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.d1_islr_pagado_anticipo.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.d1_islr_pagado_anticipo.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.d1_islr_pagado_anticipo.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';


-- Table: cuentas.d2_otros_tributos_pag

-- DROP TABLE cuentas.d2_otros_tributos_pag;

CREATE TABLE cuentas.d2_otros_tributos_pag
(
  id serial NOT NULL, -- Clave primaria
  saldo_pah numeric(38,6) NOT NULL, -- Saldo del periodo anterior historico
  credito_fiscal numeric(38,6) NOT NULL, -- Crédito Fiscal generado en el Ejercicio Económico
  monto numeric(38,6) NOT NULL, -- Monto del importe cedido en el ejercicio economico
  debito_fiscal numeric(38,6) NOT NULL, -- Debito fiscal generado en el ejercicio economico
  debito_fiscal_no numeric(38,6) NOT NULL, -- Debito fiscal no enterado
  importe_pagado numeric(38,6) NOT NULL, -- Importe pagado en el ejercicio economico
  saldo_cierre numeric(38,6), -- Saldo al cierre del ejercicio economico
  CONSTRAINT d2_otros_tributos_pag_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.d2_otros_tributos_pag
  OWNER TO eureka;
COMMENT ON TABLE cuentas.d2_otros_tributos_pag
  IS 'Tabla que representa la cuenta D-2 OTROS TRIBUTOS PAGADOS / COBRADOS POR ANTICIPADO';
COMMENT ON COLUMN cuentas.d2_otros_tributos_pag.id IS 'Clave primaria';
COMMENT ON COLUMN cuentas.d2_otros_tributos_pag.saldo_pah IS 'Saldo del periodo anterior historico';
COMMENT ON COLUMN cuentas.d2_otros_tributos_pag.credito_fiscal IS 'Crédito Fiscal generado en el Ejercicio Económico';
COMMENT ON COLUMN cuentas.d2_otros_tributos_pag.monto IS 'Monto del importe cedido en el ejercicio economico';
COMMENT ON COLUMN cuentas.d2_otros_tributos_pag.debito_fiscal IS 'Debito fiscal generado en el ejercicio economico';
COMMENT ON COLUMN cuentas.d2_otros_tributos_pag.debito_fiscal_no IS 'Debito fiscal no enterado';
COMMENT ON COLUMN cuentas.d2_otros_tributos_pag.importe_pagado IS 'Importe pagado en el ejercicio economico';
COMMENT ON COLUMN cuentas.d2_otros_tributos_pag.saldo_cierre IS 'Saldo al cierre del ejercicio economico';



-- Table: cuentas.dd3_otros_tributos

-- DROP TABLE cuentas.dd3_otros_tributos;

CREATE TABLE cuentas.dd3_otros_tributos
(
  id serial NOT NULL, -- Clave primaria
  tributo character varying(255) NOT NULL, -- Tipo de tributo que tiene el contratista
  saldo_p_anterior numeric(38,6) NOT NULL, -- Saldo del periodo anterior
  importe_gasto_ejer_eco numeric(38,6) NOT NULL, -- Importe Gasto del Ejercicio Económico
  importe_pago_ejer_eco numeric(38,6) NOT NULL, -- Importe Pago del Ejercicio Económico
  saldo_al_cierre numeric(38,6) NOT NULL, -- Saldo al cierre del ejercicio economico, calculado por el sistema
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT dd3_otros_tributos_pkey PRIMARY KEY (id),
  CONSTRAINT dd3_otros_tributos_contratista_id_fkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.dd3_otros_tributos
  OWNER TO eureka;
COMMENT ON TABLE cuentas.dd3_otros_tributos
  IS 'Tabla  pasivo laboral cuenta HH';
COMMENT ON COLUMN cuentas.dd3_otros_tributos.id IS 'Clave primaria';
COMMENT ON COLUMN cuentas.dd3_otros_tributos.tributo IS 'Tipo de tributo que tiene el contratista';
COMMENT ON COLUMN cuentas.dd3_otros_tributos.saldo_p_anterior IS 'Saldo del periodo anterior';
COMMENT ON COLUMN cuentas.dd3_otros_tributos.importe_gasto_ejer_eco IS 'Importe Gasto del Ejercicio Económico';
COMMENT ON COLUMN cuentas.dd3_otros_tributos.importe_pago_ejer_eco IS 'Importe Pago del Ejercicio Económico';
COMMENT ON COLUMN cuentas.dd3_otros_tributos.saldo_al_cierre IS 'Saldo al cierre del ejercicio economico, calculado por el sistema';
COMMENT ON COLUMN cuentas.dd3_otros_tributos.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.dd3_otros_tributos.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.dd3_otros_tributos.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.dd3_otros_tributos.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.dd3_otros_tributos.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.dd3_otros_tributos.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.dd3_otros_tributos.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.dd3_otros_tributos.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';


-- Table: cuentas.hh_pasivo_laboral

-- DROP TABLE cuentas.hh_pasivo_laboral;

CREATE TABLE cuentas.hh_pasivo_laboral
(
  id serial NOT NULL, -- Clave primaria
  concepto character varying(255) NOT NULL, -- Tipo de pasivo laboral que tiene el contratista
  saldo_p_anterior numeric(38,6) NOT NULL, -- Saldo del periodo anterior
  importe_gasto_ejer_eco numeric(38,6) NOT NULL, -- Importe Gasto del Ejercicio Económico
  importe_pago_ejer_eco numeric(38,6) NOT NULL, -- Importe Pago del Ejercicio Económico
  saldo_al_cierre numeric(38,6) NOT NULL, -- Saldo al cierre del ejercicio economico, calculado por el sistema
  corriente boolean NOT NULL DEFAULT true, -- Indica si el registro es corriente o no
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT hh_pasivo_laboral_pkey PRIMARY KEY (id),
  CONSTRAINT hh_pasivo_laboral_contratista_id_fkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.hh_pasivo_laboral
  OWNER TO eureka;
COMMENT ON TABLE cuentas.hh_pasivo_laboral
  IS 'Tabla  pasivo laboral cuenta HH';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.id IS 'Clave primaria';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.concepto IS 'Tipo de pasivo laboral que tiene el contratista';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.saldo_p_anterior IS 'Saldo del periodo anterior';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.importe_gasto_ejer_eco IS 'Importe Gasto del Ejercicio Económico';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.importe_pago_ejer_eco IS 'Importe Pago del Ejercicio Económico';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.saldo_al_cierre IS 'Saldo al cierre del ejercicio economico, calculado por el sistema';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.corriente IS 'Indica si el registro es corriente o no';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';


-- Table: cuentas.ii1_gastos_operacionales

-- DROP TABLE cuentas.ii1_gastos_operacionales;

CREATE TABLE cuentas.ii1_gastos_operacionales
(
  id serial NOT NULL, -- Clave primaria
  tipo_gasto character varying(255) NOT NULL, -- Tipo de gasto, tomando valores como: Gastos de personal Gastos de Funcionamiento Depreciación y amortización Tributos
  ventas_hist numeric(38,6) NOT NULL, -- Ventas historico
  ventas_ajustado numeric(38,6) NOT NULL, -- Ventas ajustado por inflacion
  admin_hist numeric(38,6) NOT NULL, -- Administracion historico
  admin_ajustado numeric(38,6) NOT NULL, -- Administracion ajustado por inflacion
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT ii1_gastos_operacionales_pkey PRIMARY KEY (id),
  CONSTRAINT ii1_gastos_operacionales_contratista_id_fkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.ii1_gastos_operacionales
  OWNER TO eureka;
COMMENT ON TABLE cuentas.ii1_gastos_operacionales
  IS 'Cuenta de Gastos operaciones II-1';
COMMENT ON COLUMN cuentas.ii1_gastos_operacionales.id IS 'Clave primaria';
COMMENT ON COLUMN cuentas.ii1_gastos_operacionales.tipo_gasto IS 'Tipo de gasto, tomando valores como: Gastos de personal Gastos de Funcionamiento Depreciación y amortización Tributos
';
COMMENT ON COLUMN cuentas.ii1_gastos_operacionales.ventas_hist IS 'Ventas historico';
COMMENT ON COLUMN cuentas.ii1_gastos_operacionales.ventas_ajustado IS 'Ventas ajustado por inflacion';
COMMENT ON COLUMN cuentas.ii1_gastos_operacionales.admin_hist IS 'Administracion historico';
COMMENT ON COLUMN cuentas.ii1_gastos_operacionales.admin_ajustado IS 'Administracion ajustado por inflacion';
COMMENT ON COLUMN cuentas.ii1_gastos_operacionales.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.ii1_gastos_operacionales.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.ii1_gastos_operacionales.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.ii1_gastos_operacionales.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.ii1_gastos_operacionales.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.ii1_gastos_operacionales.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.ii1_gastos_operacionales.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.ii1_gastos_operacionales.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';

ALTER TABLE cuentas.hh_pasivo_laboral DROP COLUMN concepto;

ALTER TABLE cuentas.hh_pasivo_laboral ADD COLUMN hh_concepto_id integer;
ALTER TABLE cuentas.hh_pasivo_laboral ALTER COLUMN hh_concepto_id SET NOT NULL;
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.hh_concepto_id IS 'Clave foranea a la tabla hh_concepto';

-- Table: cuentas.hh_concepto

-- DROP TABLE cuentas.hh_concepto;

CREATE TABLE cuentas.hh_concepto
(
  id serial NOT NULL, -- Clave primaria
  nombre character varying(255) NOT NULL, -- Nombre del concepto de la cuenta hh
  descripcion character varying(255), -- Descripcion del concepto
  CONSTRAINT hh_concepto_pkey PRIMARY KEY (id),
  CONSTRAINT hh_concepto_nombre_key UNIQUE (nombre)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.hh_concepto
  OWNER TO eureka;
COMMENT ON TABLE cuentas.hh_concepto
  IS 'Tabla que almacena los conceptos de la cuenta hh';
COMMENT ON COLUMN cuentas.hh_concepto.id IS 'Clave primaria';
COMMENT ON COLUMN cuentas.hh_concepto.nombre IS 'Nombre del concepto de la cuenta hh';
COMMENT ON COLUMN cuentas.hh_concepto.descripcion IS 'Descripcion del concepto';


ALTER TABLE cuentas.hh_pasivo_laboral
  ADD CONSTRAINT "Fk_concepto_hh_id" FOREIGN KEY (hh_concepto_id) REFERENCES cuentas.hh_concepto (id)
   ON UPDATE NO ACTION ON DELETE NO ACTION;
CREATE INDEX "fki_Fk_concepto_hh_id"
  ON cuentas.hh_pasivo_laboral(hh_concepto_id);

INSERT INTO cuentas.hh_concepto VALUES (1, 'Remuneraciones', NULL);
INSERT INTO cuentas.hh_concepto VALUES (2, 'Prestaciones Sociales', NULL);
INSERT INTO cuentas.hh_concepto VALUES (3, 'Indemnizaciones', NULL);
INSERT INTO cuentas.hh_concepto VALUES (4, 'Vacaciones', NULL);
INSERT INTO cuentas.hh_concepto VALUES (5, 'Otros', NULL);
 
ALTER TABLE cuentas.hh_pasivo_laboral
   ALTER COLUMN saldo_al_cierre DROP NOT NULL;
   
   
ALTER TABLE cuentas.hh_pasivo_laboral ADD COLUMN otro_nombre character varying(255);
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.otro_nombre IS 'Nombre que debe indicar el contratista si selecciona la opcion de Otros';

-------19/05/2015--------------

ALTER TABLE cuentas.c_tipos_inventarios
   ALTER COLUMN descripcion DROP NOT NULL;

   INSERT INTO cuentas.c_tipos_inventarios VALUES (3, 'MERCANCÍAS', NULL, NULL, NULL, true, '2015-05-19 22:12:23.205-04:30', '2015-05-19 22:12:23.205-04:30', NULL);
INSERT INTO cuentas.c_tipos_inventarios VALUES (4, 'MATERIAS PRIMAS', NULL, NULL, NULL, true, '2015-05-19 22:12:30.831-04:30', '2015-05-19 22:12:30.831-04:30', NULL);
INSERT INTO cuentas.c_tipos_inventarios VALUES (5, 'MATERIALES Y SUMINISTROS', NULL, NULL, NULL, true, '2015-05-19 22:12:38.576-04:30', '2015-05-19 22:12:38.831-04:30',NULL);

ALTER TABLE cuentas.c_inventarios
  ADD CONSTRAINT tipo_inventario_fk_c FOREIGN KEY (tipo_inventario_id) REFERENCES cuentas.c_tipos_inventarios (id)
   ON UPDATE NO ACTION ON DELETE NO ACTION;
CREATE INDEX fki_tipo_inventario_fk_c
  ON cuentas.c_inventarios(tipo_inventario_id);
  
  
  
------23/05/2015------------------

DROP TABLE nombres_cajas;

-- Table: nombres_cajas

-- DROP TABLE nombres_cajas;

CREATE TABLE nombres_cajas
(
  id serial NOT NULL, -- Clave primaria
  nombre character varying(255) NOT NULL, -- Nombre de la caja
  nacional boolean NOT NULL DEFAULT true, -- Indica si la caja es para moneda nacional o extranjera
  tipo_caja character varying(255) NOT NULL, -- Campo que indica si la caja es Caja o Caja chica
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT nombres_cajas_pkey PRIMARY KEY (id),
  CONSTRAINT nombres_cajas_contratista_id_fkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT nombres_cajas_nombre_nacional_tipo_caja_contratista_id_key UNIQUE (nombre, nacional, tipo_caja, contratista_id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE nombres_cajas
  OWNER TO eureka;
COMMENT ON TABLE nombres_cajas
  IS 'Nombre de las cajas que tienen los contratistas';
COMMENT ON COLUMN nombres_cajas.id IS 'Clave primaria';
COMMENT ON COLUMN nombres_cajas.nombre IS 'Nombre de la caja';
COMMENT ON COLUMN nombres_cajas.nacional IS 'Indica si la caja es para moneda nacional o extranjera';
COMMENT ON COLUMN nombres_cajas.tipo_caja IS 'Campo que indica si la caja es Caja o Caja chica';
COMMENT ON COLUMN nombres_cajas.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN nombres_cajas.anho IS 'Año contable y mes';
COMMENT ON COLUMN nombres_cajas.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN nombres_cajas.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN nombres_cajas.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN nombres_cajas.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN nombres_cajas.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN nombres_cajas.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';




CREATE TABLE cuentas.jj_proviciones
(
  id serial NOT NULL, -- Clave primaria
  concepto character varying(255) NOT NULL, -- Tipo de pasivo laboral que tiene el contratista
  saldo_p_anterior numeric(38,6) NOT NULL, -- Saldo del periodo anterior
  importe_provisionado_periodo numeric(38,6) NOT NULL, -- Importe Provisionado del periodo
  aplicacion_amortizacion numeric(38,6) NOT NULL, -- Aplicación o Amortizacion del periodo
  saldo_al_cierre numeric(38,6) NOT NULL, -- Saldo al cierre del ejercicio economico, calculado por el sistema
  corriente boolean NOT NULL DEFAULT true, -- Indica si el registro es corriente o no
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT jj_proviciones_pkey PRIMARY KEY (id),
  CONSTRAINT jj_proviciones_contratista_id_fkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.jj_proviciones
  OWNER TO eureka;
COMMENT ON TABLE cuentas.jj_proviciones
  IS 'Tabla  pasivo laboral cuenta HH';
COMMENT ON COLUMN cuentas.jj_proviciones.id IS 'Clave primaria';
COMMENT ON COLUMN cuentas.jj_proviciones.concepto IS 'Tipo de pasivo laboral que tiene el contratista';
COMMENT ON COLUMN cuentas.jj_proviciones.saldo_p_anterior IS 'Saldo del periodo anterior';
COMMENT ON COLUMN cuentas.jj_proviciones.importe_provisionado_periodo IS 'Importe Provisionado del periodo';
COMMENT ON COLUMN cuentas.jj_proviciones.aplicacion_amortizacion IS 'Aplicación o Amortizacion del periodo';
COMMENT ON COLUMN cuentas.jj_proviciones.saldo_al_cierre IS 'Saldo al cierre del ejercicio economico, calculado por el sistema';
COMMENT ON COLUMN cuentas.jj_proviciones.corriente IS 'Indica si el registro es corriente o no';
COMMENT ON COLUMN cuentas.jj_proviciones.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.jj_proviciones.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.jj_proviciones.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.jj_proviciones.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.jj_proviciones.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.jj_proviciones.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.jj_proviciones.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.jj_proviciones.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';

----------24/05/2015--------------

DROP TABLE cuentas.jj_proviciones;
DROP TABLE cuentas.hh_pasivo_laboral;
DROP TABLE cuentas.hh_concepto;

CREATE TABLE cuentas.conceptos
(
  id integer NOT NULL DEFAULT nextval('cuentas.hh_concepto_id_seq'::regclass), -- Clave primaria
  nombre character varying(255) NOT NULL, -- Nombre del concepto de la cuenta hh
  descripcion character varying(255), -- Descripcion del concepto
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  cuenta character varying(255), -- Indica a que cuenta pertence el concepto
  CONSTRAINT hh_concepto_pkey PRIMARY KEY (id),
  CONSTRAINT hh_concepto_nombre_cuenta_key UNIQUE (nombre, cuenta)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.conceptos
  OWNER TO eureka;
COMMENT ON TABLE cuentas.conceptos
  IS 'Tabla que almacena los conceptos de la cuenta hh';
COMMENT ON COLUMN cuentas.conceptos.id IS 'Clave primaria';
COMMENT ON COLUMN cuentas.conceptos.nombre IS 'Nombre del concepto de la cuenta hh';
COMMENT ON COLUMN cuentas.conceptos.descripcion IS 'Descripcion del concepto';
COMMENT ON COLUMN cuentas.conceptos.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.conceptos.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.conceptos.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.conceptos.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.conceptos.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.conceptos.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';
COMMENT ON COLUMN cuentas.conceptos.cuenta IS 'Indica a que cuenta pertence el concepto';

-- Table: cuentas.hh_pasivo_laboral

-- DROP TABLE cuentas.hh_pasivo_laboral;

CREATE TABLE cuentas.hh_pasivo_laboral
(
  id serial NOT NULL, -- Clave primaria
  saldo_p_anterior numeric(38,6) NOT NULL, -- Saldo del periodo anterior
  importe_gasto_ejer_eco numeric(38,6) NOT NULL, -- Importe Gasto del Ejercicio Económico
  importe_pago_ejer_eco numeric(38,6) NOT NULL, -- Importe Pago del Ejercicio Económico
  saldo_al_cierre numeric(38,6), -- Saldo al cierre del ejercicio economico, calculado por el sistema
  corriente boolean NOT NULL DEFAULT true, -- Indica si el registro es corriente o no
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  hh_concepto_id integer NOT NULL, -- Clave foranea a la tabla hh_concepto
  otro_nombre character varying(255), -- Nombre que debe indicar el contratista si selecciona la opcion de Otros
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT hh_pasivo_laboral_pkey PRIMARY KEY (id),
  CONSTRAINT "Fk_concepto_hh_id" FOREIGN KEY (hh_concepto_id)
      REFERENCES cuentas.conceptos (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT hh_pasivo_laboral_contratista_id_fkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.hh_pasivo_laboral
  OWNER TO eureka;
COMMENT ON TABLE cuentas.hh_pasivo_laboral
  IS 'Tabla  pasivo laboral cuenta HH';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.id IS 'Clave primaria';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.saldo_p_anterior IS 'Saldo del periodo anterior';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.importe_gasto_ejer_eco IS 'Importe Gasto del Ejercicio Económico';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.importe_pago_ejer_eco IS 'Importe Pago del Ejercicio Económico';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.saldo_al_cierre IS 'Saldo al cierre del ejercicio economico, calculado por el sistema';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.corriente IS 'Indica si el registro es corriente o no';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.hh_concepto_id IS 'Clave foranea a la tabla hh_concepto';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.otro_nombre IS 'Nombre que debe indicar el contratista si selecciona la opcion de Otros';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.hh_pasivo_laboral.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';




CREATE TABLE cuentas.jj_proviciones
(
  id serial NOT NULL, -- Clave primaria
  saldo_p_anterior numeric(38,6) NOT NULL, -- Saldo del periodo anterior
  importe_provisionado_periodo numeric(38,6) NOT NULL, -- Importe Provisionado del periodo
  aplicacion_amortizacion numeric(38,6) NOT NULL, -- Aplicación o Amortizacion del periodo
  saldo_al_cierre numeric(38,6) NOT NULL, -- Saldo al cierre del ejercicio economico, calculado por el sistema
  corriente boolean NOT NULL DEFAULT true, -- Indica si el registro es corriente o no
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  concepto_id integer NOT NULL, -- Clave foranea a la tabla Concepto
  CONSTRAINT jj_proviciones_pkey PRIMARY KEY (id),
  CONSTRAINT jj_proviciones_concepto_id_fkey FOREIGN KEY (concepto_id)
      REFERENCES cuentas.conceptos (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT jj_proviciones_contratista_id_fkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cuentas.jj_proviciones
  OWNER TO eureka;
COMMENT ON TABLE cuentas.jj_proviciones
  IS 'Tabla  pasivo laboral cuenta HH';
COMMENT ON COLUMN cuentas.jj_proviciones.id IS 'Clave primaria';
COMMENT ON COLUMN cuentas.jj_proviciones.saldo_p_anterior IS 'Saldo del periodo anterior';
COMMENT ON COLUMN cuentas.jj_proviciones.importe_provisionado_periodo IS 'Importe Provisionado del periodo';
COMMENT ON COLUMN cuentas.jj_proviciones.aplicacion_amortizacion IS 'Aplicación o Amortizacion del periodo';
COMMENT ON COLUMN cuentas.jj_proviciones.saldo_al_cierre IS 'Saldo al cierre del ejercicio economico, calculado por el sistema';
COMMENT ON COLUMN cuentas.jj_proviciones.corriente IS 'Indica si el registro es corriente o no';
COMMENT ON COLUMN cuentas.jj_proviciones.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.jj_proviciones.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.jj_proviciones.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.jj_proviciones.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.jj_proviciones.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.jj_proviciones.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.jj_proviciones.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.jj_proviciones.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';
COMMENT ON COLUMN cuentas.jj_proviciones.concepto_id IS 'Clave foranea a la tabla Concepto';




INSERT INTO conceptos VALUES (1, 'Remuneraciones', NULL, NULL, NULL, true, '2015-05-19 00:41:10.354-04:30', '2015-05-19 00:41:10.354-04:30', NULL, 'hh');
INSERT INTO conceptos VALUES (2, 'Prestaciones Sociales', NULL, NULL, NULL, true, '2015-05-19 00:41:10.354-04:30', '2015-05-19 00:41:10.354-04:30', NULL, 'hh');
INSERT INTO conceptos VALUES (3, 'Indemnizaciones', NULL, NULL, NULL, true, '2015-05-19 00:41:10.354-04:30', '2015-05-19 00:41:10.354-04:30', NULL, 'hh');
INSERT INTO conceptos VALUES (4, 'Vacaciones', NULL, NULL, NULL, true, '2015-05-19 00:41:10.354-04:30', '2015-05-19 00:41:10.354-04:30', NULL, 'hh');
INSERT INTO conceptos VALUES (5, 'Otros', NULL, NULL, NULL, true, '2015-05-19 00:41:10.354-04:30', '2015-05-19 00:41:10.354-04:30', NULL, 'hh');
INSERT INTO conceptos VALUES (6, 'Utilidades', '
', NULL, NULL, true, '2015-05-24 11:43:05.53-04:30', '2015-05-24 11:43:05.53-04:30', NULL, 'jj');
INSERT INTO conceptos VALUES (7, 'Vacaciones', NULL, NULL, NULL, true, '2015-05-24 11:43:13.748-04:30', '2015-05-24 11:43:13.748-04:30', NULL, 'jj');
INSERT INTO conceptos VALUES (8, 'Prestaciones sociales', NULL, NULL, NULL, true, '2015-05-24 11:43:24.668-04:30', '2015-05-24 11:43:24.668-04:30', NULL, 'jj');
INSERT INTO conceptos VALUES (9, 'Otras retibuciones laborales', NULL, NULL, NULL, true, '2015-05-24 11:43:37.616-04:30', '2015-05-24 11:43:37.616-04:30', NULL, 'jj');
INSERT INTO conceptos VALUES (10, 'Provisiones para litigios', NULL, NULL, NULL, true, '2015-05-24 11:43:51.544-04:30', '2015-05-24 11:43:51.544-04:30', NULL, 'jj');
INSERT INTO conceptos VALUES (11, 'Provisiones para contingencias', NULL, NULL, NULL, true, '2015-05-24 11:44:03.463-04:30', '2015-05-24 11:44:03.463-04:30', NULL, 'jj');
INSERT INTO conceptos VALUES (12, 'Otros', NULL, NULL, NULL, true, '2015-05-24 11:44:10.667-04:30', '2015-05-24 11:44:10.667-04:30', NULL, 'jj');


--
-- TOC entry 2766 (class 0 OID 0)
-- Dependencies: 270
-- Name: hh_concepto_id_seq; Type: SEQUENCE SET; Schema: cuentas; Owner: eureka
--

SELECT pg_catalog.setval('hh_concepto_id_seq', 12, true);



ALTER TABLE cuentas.d1_d2_beneficiario
   ADD COLUMN cuenta_id integer;
COMMENT ON COLUMN cuentas.d1_d2_beneficiario.cuenta_id
  IS 'Identificador del registro que indica el beneficiario';

  
ALTER TABLE cuentas.d1_d2_beneficiario
   ADD COLUMN cuenta character varying(50);
COMMENT ON COLUMN cuentas.d1_d2_beneficiario.cuenta
  IS 'Campo que indica a que cuenta pertenece el registro';

-------------------------------- 5:40----------------------

ALTER TABLE cuentas.dd3_otros_tributos
  DROP COLUMN tributo;
ALTER TABLE cuentas.dd3_otros_tributos
  ADD COLUMN concepto_id integer NOT NULL;
ALTER TABLE cuentas.dd3_otros_tributos
  ADD FOREIGN KEY (concepto_id) REFERENCES cuentas.conceptos (id) ON UPDATE NO ACTION ON DELETE NO ACTION;
COMMENT ON COLUMN cuentas.dd3_otros_tributos.concepto_id IS 'Clave foranea a la tabla Conceptos';


INSERT INTO conceptos VALUES (13, 'Aporte patronal IVSS', NULL, NULL, NULL, true, '2015-05-24 17:43:51.099-04:30', '2015-05-24 17:43:51.099-04:30', NULL, 'dd3');
INSERT INTO conceptos VALUES (14, 'Aporte patronal FAOV', NULL, NULL, NULL, true, '2015-05-24 17:44:08.286-04:30', '2015-05-24 17:44:08.286-04:30', NULL, 'dd3');
INSERT INTO conceptos VALUES (17, 'Aporte patronal INCES', NULL, NULL, NULL, true, '2015-05-24 17:44:21.279-04:30', '2015-05-24 17:44:21.279-04:30', NULL, 'dd3');
INSERT INTO conceptos VALUES (20, 'Aporte patronal Vivienda y Hábitat', NULL, NULL, NULL, true, '2015-05-24 17:44:36.766-04:30', '2015-05-24 17:44:36.766-04:30', NULL, 'dd3');
INSERT INTO conceptos VALUES (23, 'Retenciones por enterar', NULL, NULL, NULL, true, '2015-05-24 17:44:48.194-04:30', '2015-05-24 17:44:48.194-04:30', NULL, 'dd3');
INSERT INTO conceptos VALUES (24, 'Otros', NULL, NULL, NULL, true, '2015-05-24 17:44:57.577-04:30', '2015-05-24 17:44:57.577-04:30', NULL, 'dd3');


ALTER TABLE cuentas.dd3_otros_tributos
   ADD COLUMN otro_nombre character varying(255);
COMMENT ON COLUMN cuentas.dd3_otros_tributos.otro_nombre
  IS 'Campo que almacena la especificación en caso de tildar Otros';


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


