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
