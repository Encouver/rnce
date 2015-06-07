/**************     26/05/2015 *************/


-- Column: contratista_id

ALTER TABLE nombres_cajas DROP COLUMN IF EXISTS contratista_id;

ALTER TABLE nombres_cajas ADD COLUMN contratista_id integer;
ALTER TABLE nombres_cajas ALTER COLUMN contratista_id SET NOT NULL;
COMMENT ON COLUMN nombres_cajas.contratista_id IS 'Clave foranea al contratista';

ALTER TABLE nombres_cajas
ADD FOREIGN KEY (contratista_id) REFERENCES contratistas (id) ON UPDATE CASCADE ON DELETE NO ACTION;

-- Column: anho

ALTER TABLE nombres_cajas DROP COLUMN IF EXISTS anho;

ALTER TABLE nombres_cajas ADD COLUMN anho character varying(100);
ALTER TABLE nombres_cajas ALTER COLUMN anho SET NOT NULL;
COMMENT ON COLUMN nombres_cajas.anho IS 'Año contable y mes';


ALTER TABLE nombres_cajas
  DROP COLUMN contratistas_id;




/**************     27/05/2015 *************/

ALTER TABLE activos.vehiculos RENAME anho  TO anho_vehiculo;
COMMENT ON COLUMN activos.vehiculos.anho_vehiculo
IS 'Año del vehiculo.';
COMMENT ON COLUMN activos.vehiculos.anho_vehiculo IS 'Año del vehiculo.';


/**************     28/05/2015 *************/

COMMENT ON COLUMN activos.desincorporacion_activos.sys_motivo_id
IS 'Clave foranea a la tabla sys_motivos.';
COMMENT ON COLUMN activos.desincorporacion_activos.fecha
IS 'Fecha de la desincorporación.';
COMMENT ON COLUMN activos.desincorporacion_activos.precio_venta
IS 'Precio de venta.';
ALTER TABLE activos.desincorporacion_activos
ALTER COLUMN valor_neto_libro TYPE numeric(38,6);
COMMENT ON COLUMN activos.desincorporacion_activos.valor_neto_libro
IS 'Valor neto según libro.';
COMMENT ON COLUMN activos.desincorporacion_activos.sys_motivo_id IS 'Clave foranea a la tabla sys_motivos.';
COMMENT ON COLUMN activos.desincorporacion_activos.fecha IS 'Fecha de la desincorporación.';
COMMENT ON COLUMN activos.desincorporacion_activos.precio_venta IS 'Precio de venta.';
COMMENT ON COLUMN activos.desincorporacion_activos.valor_neto_libro IS 'Valor neto según libro.';




/**************     30/05/2015 *************/

-- Table: usuarios_contratistas

-- DROP TABLE usuarios_contratistas;

CREATE TABLE usuarios_contratistas
(
  id serial NOT NULL, -- Clave primaria.
  user_id integer NOT NULL, -- Clave foránea a la tabla user.
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT usuarios_contratistas_pkey PRIMARY KEY (id),
  CONSTRAINT usuarios_contratistas_contratista_id_fkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT usuarios_contratistas_user_id_fkey FOREIGN KEY (user_id)
      REFERENCES "user" (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT usuarios_contratistas_user_id_contratista_id_key UNIQUE (user_id, contratista_id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE usuarios_contratistas
  OWNER TO eureka;
COMMENT ON TABLE usuarios_contratistas
  IS 'Relación entre los usuarios y los contratistas.';
COMMENT ON COLUMN usuarios_contratistas.id IS 'Clave primaria.';
COMMENT ON COLUMN usuarios_contratistas.user_id IS 'Clave foránea a la tabla user.';
COMMENT ON COLUMN usuarios_contratistas.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN usuarios_contratistas.anho IS 'Año contable y mes';
COMMENT ON COLUMN usuarios_contratistas.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN usuarios_contratistas.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN usuarios_contratistas.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN usuarios_contratistas.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN usuarios_contratistas.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN usuarios_contratistas.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';





/**************     06/06/2015 *************/

-- Table: cuentas.d2_otros_tributos_pag

DROP TABLE cuentas.d2_otros_tributos_pag;

CREATE TABLE cuentas.d2_otros_tributos_pag
(
  id serial NOT NULL, -- Clave primaria
  otros_tributos_id integer NOT NULL, -- Saldo del periodo anterior historico
  saldo_pah numeric(38,6) NOT NULL, -- Saldo del periodo anterior historico
  credito_fiscal numeric(38,6) NOT NULL, -- Crédito Fiscal generado en el Ejercicio Económico
  monto numeric(38,6) NOT NULL, -- Monto del importe cedido en el ejercicio economico
  debito_fiscal numeric(38,6) NOT NULL, -- Debito fiscal generado en el ejercicio economico
  debito_fiscal_no numeric(38,6) NOT NULL, -- Debito fiscal no enterado
  importe_pagado numeric(38,6) NOT NULL, -- Importe pagado en el ejercicio economico
  saldo_cierre numeric(38,6), -- Saldo al cierre del ejercicio economico
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT d2_otros_tributos_pag_pkey PRIMARY KEY (id),
  CONSTRAINT d2_otros_tributos_pag_contratista_id_fkey FOREIGN KEY (contratista_id)
  REFERENCES contratistas (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT d2_otros_tributos_pag_otros_tributos_id_fkey FOREIGN KEY (otros_tributos_id)
  REFERENCES cuentas.conceptos (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT d2_otros_tributos_pag_otros_tributos_id_contratista_id_key UNIQUE (otros_tributos_id, contratista_id)
)
WITH (
OIDS=FALSE
);
ALTER TABLE cuentas.d2_otros_tributos_pag
OWNER TO eureka;
COMMENT ON TABLE cuentas.d2_otros_tributos_pag
IS 'Tabla que representa la cuenta D-2 OTROS TRIBUTOS PAGADOS / COBRADOS POR ANTICIPADO';
COMMENT ON COLUMN cuentas.d2_otros_tributos_pag.id IS 'Clave primaria';
COMMENT ON COLUMN cuentas.d2_otros_tributos_pag.otros_tributos_id IS 'Clave foránea a la tabla conceptos';
COMMENT ON COLUMN cuentas.d2_otros_tributos_pag.saldo_pah IS 'Saldo del periodo anterior historico';
COMMENT ON COLUMN cuentas.d2_otros_tributos_pag.credito_fiscal IS 'Crédito Fiscal generado en el Ejercicio Económico';
COMMENT ON COLUMN cuentas.d2_otros_tributos_pag.monto IS 'Monto del importe cedido en el ejercicio economico';
COMMENT ON COLUMN cuentas.d2_otros_tributos_pag.debito_fiscal IS 'Debito fiscal generado en el ejercicio economico';
COMMENT ON COLUMN cuentas.d2_otros_tributos_pag.debito_fiscal_no IS 'Debito fiscal no enterado';
COMMENT ON COLUMN cuentas.d2_otros_tributos_pag.importe_pagado IS 'Importe pagado en el ejercicio economico';
COMMENT ON COLUMN cuentas.d2_otros_tributos_pag.saldo_cierre IS 'Saldo al cierre del ejercicio economico';
COMMENT ON COLUMN cuentas.d2_otros_tributos_pag.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.d2_otros_tributos_pag.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.d2_otros_tributos_pag.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.d2_otros_tributos_pag.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.d2_otros_tributos_pag.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.d2_otros_tributos_pag.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.d2_otros_tributos_pag.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.d2_otros_tributos_pag.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';




ALTER TABLE cuentas.conceptos
RENAME TO sys_conceptos;
COMMENT ON TABLE cuentas.sys_conceptos
IS 'Tabla que almacena los conceptos de las cuentas.';



-- Column: contratista_id

ALTER TABLE cuentas.i2_imp_sobre_renta DROP COLUMN IF EXISTS contratista_id;

ALTER TABLE cuentas.i2_imp_sobre_renta ADD COLUMN contratista_id integer;
ALTER TABLE cuentas.i2_imp_sobre_renta ALTER COLUMN contratista_id SET NOT NULL;
COMMENT ON COLUMN cuentas.i2_imp_sobre_renta.contratista_id IS 'Clave foranea al contratista';

ALTER TABLE cuentas.i2_imp_sobre_renta
ADD FOREIGN KEY (contratista_id) REFERENCES contratistas (id) ON UPDATE CASCADE ON DELETE NO ACTION;

-- Column: anho

ALTER TABLE cuentas.i2_imp_sobre_renta DROP COLUMN IF EXISTS anho;

ALTER TABLE cuentas.i2_imp_sobre_renta ADD COLUMN anho character varying(100);
ALTER TABLE cuentas.i2_imp_sobre_renta ALTER COLUMN anho SET NOT NULL;
COMMENT ON COLUMN cuentas.i2_imp_sobre_renta.anho IS 'Año contable y mes';


-- Column: contratista_id

ALTER TABLE cuentas.i2_declaracion_eg_in DROP COLUMN IF EXISTS contratista_id;

ALTER TABLE cuentas.i2_declaracion_eg_in ADD COLUMN contratista_id integer;
ALTER TABLE cuentas.i2_declaracion_eg_in ALTER COLUMN contratista_id SET NOT NULL;
COMMENT ON COLUMN cuentas.i2_declaracion_eg_in.contratista_id IS 'Clave foranea al contratista';

ALTER TABLE cuentas.i2_declaracion_eg_in
ADD FOREIGN KEY (contratista_id) REFERENCES contratistas (id) ON UPDATE CASCADE ON DELETE NO ACTION;

-- Column: anho

ALTER TABLE cuentas.i2_declaracion_eg_in DROP COLUMN IF EXISTS anho;

ALTER TABLE cuentas.i2_declaracion_eg_in ADD COLUMN anho character varying(100);
ALTER TABLE cuentas.i2_declaracion_eg_in ALTER COLUMN anho SET NOT NULL;
COMMENT ON COLUMN cuentas.i2_declaracion_eg_in.anho IS 'Año contable y mes';




ALTER TABLE cuentas.i2_declaracion_eg_in
RENAME TO i2_declaracion_iva;
COMMENT ON TABLE cuentas.i2_declaracion_iva
IS 'Cuenta I2 - Declaración de ingresos y egresos según IVA.';


ALTER TABLE cuentas.i2_imp_sobre_renta
RENAME TO i2_declaracion_islr;
COMMENT ON TABLE cuentas.i2_declaracion_islr
IS 'Cuenta I2 - Declaración de impuesto sobre la renta (ISLR).';


COMMENT ON COLUMN cuentas.i2_declaracion_islr.tipo_declaracion_id
IS 'Clave foránea a la tabla sys_conceptos.';
ALTER TABLE cuentas.i2_declaracion_islr
DROP CONSTRAINT i2_imp_sobre_renta_tipo_declaracion_id_fkey;
ALTER TABLE cuentas.i2_declaracion_islr
ADD FOREIGN KEY (tipo_declaracion_id) REFERENCES cuentas.sys_totales (id) ON UPDATE NO ACTION ON DELETE NO ACTION;
COMMENT ON COLUMN cuentas.i2_declaracion_islr.tipo_declaracion_id IS 'Clave foránea a la tabla sys_conceptos.';


-- Table: cuentas.i2_tipos_declaraciones_islr

DROP TABLE cuentas.i2_tipos_declaraciones_islr;


ALTER TABLE cuentas.sys_periodos
ALTER COLUMN descripcion DROP NOT NULL;
COMMENT ON COLUMN cuentas.sys_periodos.descripcion IS 'Descripcion del periodo.';

ALTER TABLE cuentas.sys_periodos
DROP CONSTRAINT sys_periodos_nombre_key;
ALTER TABLE cuentas.sys_periodos
ADD UNIQUE (nombre, descripcion);


ALTER TABLE cuentas.i2_declaracion_islr
ADD UNIQUE (tipo_declaracion_id, contratista_id, anho);


ALTER TABLE cuentas.i2_declaracion_iva
ADD UNIQUE (periodo_id, contratista_id, anho);


ALTER TABLE cuentas.d1_islr_pagado_anticipo
DROP CONSTRAINT d1_islr_pagado_anticipo_islr_pagado_id_contratista_id_key;
ALTER TABLE cuentas.d1_islr_pagado_anticipo
ADD UNIQUE (islr_pagado_id, contratista_id, anho);

ALTER TABLE cuentas.d2_otros_tributos_pag
DROP CONSTRAINT d2_otros_tributos_pag_otros_tributos_id_contratista_id_key;
ALTER TABLE cuentas.d2_otros_tributos_pag
ADD UNIQUE (otros_tributos_id, contratista_id, anho);


ALTER TABLE cuentas.i2_declaracion_islr
DROP CONSTRAINT i2_declaracion_islr_tipo_declaracion_id_fkey;
ALTER TABLE cuentas.i2_declaracion_islr
ADD FOREIGN KEY (tipo_declaracion_id) REFERENCES cuentas.sys_conceptos (id) ON UPDATE NO ACTION ON DELETE NO ACTION;



/**************     07/06/2015 *************/

-- Table: cuentas.sys_clasificaciones_conceptos

-- DROP TABLE cuentas.sys_clasificaciones_conceptos;

CREATE TABLE cuentas.sys_clasificaciones_conceptos
(
  id serial NOT NULL, -- Clave primaria.
  nombre character varying(255) NOT NULL, -- Nombre de la clasificación.
  descripcion character varying(255), -- Descripción de la clasificación.
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT sys_clasificaciones_conceptos_pkey PRIMARY KEY (id),
  CONSTRAINT sys_clasificaciones_conceptos_nombre_descripcion_key UNIQUE (nombre, descripcion)
)
WITH (
OIDS=FALSE
);
ALTER TABLE cuentas.sys_clasificaciones_conceptos
OWNER TO eureka;
COMMENT ON TABLE cuentas.sys_clasificaciones_conceptos
IS 'Clasificaciones de los conceptos.';
COMMENT ON COLUMN cuentas.sys_clasificaciones_conceptos.id IS 'Clave primaria.';
COMMENT ON COLUMN cuentas.sys_clasificaciones_conceptos.nombre IS 'Nombre de la clasificación.';
COMMENT ON COLUMN cuentas.sys_clasificaciones_conceptos.descripcion IS 'Descripción de la clasificación.';
COMMENT ON COLUMN cuentas.sys_clasificaciones_conceptos.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.sys_clasificaciones_conceptos.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.sys_clasificaciones_conceptos.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.sys_clasificaciones_conceptos.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.sys_clasificaciones_conceptos.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.sys_clasificaciones_conceptos.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';




ALTER TABLE cuentas.sys_conceptos
ADD COLUMN sys_clasificacion_id integer;
ALTER TABLE cuentas.sys_conceptos
ADD COLUMN carga_sistema boolean DEFAULT false;
ALTER TABLE cuentas.sys_conceptos
ADD FOREIGN KEY (sys_clasificacion_id) REFERENCES cuentas.sys_clasificaciones_conceptos (id) ON UPDATE NO ACTION ON DELETE NO ACTION;
COMMENT ON COLUMN cuentas.sys_conceptos.sys_clasificacion_id IS 'Clave foránea a la tabla sys_clasificaciones_conceptos.';
COMMENT ON COLUMN cuentas.sys_conceptos.carga_sistema IS 'Indica si este tipo de concepto se cargara por el sistema.';
