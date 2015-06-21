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






/**************     08/06/2015 *************/

-- Table: cuentas.i4_costos_personal

-- DROP TABLE cuentas.i4_costos_personal;

CREATE TABLE cuentas.i4_costos_personal
(
  id integer NOT NULL DEFAULT nextval('cuentas.i4_costos_personal_id_seq1'::regclass), -- Clave primaria.
  objeto_empresa_id integer NOT NULL, -- Clave foránea a la tabla sys_conceptos.
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT i4_costos_personal_pkey1 PRIMARY KEY (id),
  CONSTRAINT i4_costos_personal_contratista_id_fkey FOREIGN KEY (contratista_id)
  REFERENCES contratistas (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT i4_costos_personal_objeto_empresa_id_fkey FOREIGN KEY (objeto_empresa_id)
  REFERENCES cuentas.sys_conceptos (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT i4_costos_personal_objeto_empresa_id_contratista_id_anho_key UNIQUE (objeto_empresa_id, contratista_id, anho)
)
WITH (
OIDS=FALSE
);
ALTER TABLE cuentas.i4_costos_personal
OWNER TO eureka;
COMMENT ON TABLE cuentas.i4_costos_personal
IS 'Tabla principal de la Cuenta I-4 Costos personal.';
COMMENT ON COLUMN cuentas.i4_costos_personal.id IS 'Clave primaria.';
COMMENT ON COLUMN cuentas.i4_costos_personal.objeto_empresa_id IS 'Clave foránea a la tabla sys_conceptos.';
COMMENT ON COLUMN cuentas.i4_costos_personal.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.i4_costos_personal.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.i4_costos_personal.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.i4_costos_personal.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.i4_costos_personal.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.i4_costos_personal.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.i4_costos_personal.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.i4_costos_personal.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';

-- Table: cuentas.i4_costos_personal_objeto

-- DROP TABLE cuentas.i4_costos_personal_objeto;

CREATE TABLE cuentas.i4_costos_personal_objeto
(
  id integer NOT NULL DEFAULT nextval('cuentas.i4_costos_personal_id_seq'::regclass), -- Clave primaria.
  monto_mano_directa numeric(38,6) NOT NULL, -- Monto de la mano de obra Directa.
  metodo_inflacion_directa integer NOT NULL, -- Clave foránea a la tabla sys_metodos_medicion.
  desde_directa date NOT NULL, -- Inicio para le cálculo de la inflación.
  hasta_directa date NOT NULL, -- Fecha final para el cálculo de la inflación.
  mdo_ajustado_directa numeric(38,6) NOT NULL, -- Monto de la mano de obra directa ajustado.
  monto_mano_indirecta numeric(38,6) NOT NULL, -- Monto de la mano de obra indirecta.
  metodo_inflacion_indirecta integer NOT NULL, -- Clave foránea a la tabla sys_metodos_medicion.
  desde_indirecta date NOT NULL, -- Inicio para le cálculo de la inflación.
  hasta_indirecta date NOT NULL, -- Fecha final para el cálculo de la inflación.
  mdo_ajustado_indirecta numeric(38,6) NOT NULL, -- Monto de la mano de obra indirecta ajustado.
  concepto_id integer NOT NULL, -- Clave foránea a la tabla sys_conceptos.
  cp_objeto_id integer NOT NULL, -- Clave foránea a la tabla i4_costos_personal.
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  especifique character varying(255), -- Campo opcional para especificar en caso de moticos sea otros.
  CONSTRAINT i4_costos_personal_pkey PRIMARY KEY (id),
  CONSTRAINT i4_costos_personal_objeto_concepto_id_fkey FOREIGN KEY (concepto_id)
  REFERENCES cuentas.sys_conceptos (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT i4_costos_personal_objeto_contratista_id_fkey FOREIGN KEY (contratista_id)
  REFERENCES contratistas (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT i4_costos_personal_objeto_objeto_empresa_id_fkey FOREIGN KEY (cp_objeto_id)
  REFERENCES cuentas.i4_costos_personal (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT i4_costos_personal_objeto_contratista_id_anho_cp_objeto_id_key UNIQUE (contratista_id, anho, cp_objeto_id)
)
WITH (
OIDS=FALSE
);
ALTER TABLE cuentas.i4_costos_personal_objeto
OWNER TO eureka;
COMMENT ON TABLE cuentas.i4_costos_personal_objeto
IS 'Cuenta I-4 Costos personal.';
COMMENT ON COLUMN cuentas.i4_costos_personal_objeto.id IS 'Clave primaria.';
COMMENT ON COLUMN cuentas.i4_costos_personal_objeto.monto_mano_directa IS 'Monto de la mano de obra Directa.';
COMMENT ON COLUMN cuentas.i4_costos_personal_objeto.metodo_inflacion_directa IS 'Clave foránea a la tabla sys_metodos_medicion.';
COMMENT ON COLUMN cuentas.i4_costos_personal_objeto.desde_directa IS 'Inicio para le cálculo de la inflación.';
COMMENT ON COLUMN cuentas.i4_costos_personal_objeto.hasta_directa IS 'Fecha final para el cálculo de la inflación.';
COMMENT ON COLUMN cuentas.i4_costos_personal_objeto.mdo_ajustado_directa IS 'Monto de la mano de obra directa ajustado.';
COMMENT ON COLUMN cuentas.i4_costos_personal_objeto.monto_mano_indirecta IS 'Monto de la mano de obra indirecta.';
COMMENT ON COLUMN cuentas.i4_costos_personal_objeto.metodo_inflacion_indirecta IS 'Clave foránea a la tabla sys_metodos_medicion.';
COMMENT ON COLUMN cuentas.i4_costos_personal_objeto.desde_indirecta IS 'Inicio para le cálculo de la inflación.';
COMMENT ON COLUMN cuentas.i4_costos_personal_objeto.hasta_indirecta IS 'Fecha final para el cálculo de la inflación.';
COMMENT ON COLUMN cuentas.i4_costos_personal_objeto.mdo_ajustado_indirecta IS 'Monto de la mano de obra indirecta ajustado.';
COMMENT ON COLUMN cuentas.i4_costos_personal_objeto.concepto_id IS 'Clave foránea a la tabla sys_conceptos.';
COMMENT ON COLUMN cuentas.i4_costos_personal_objeto.cp_objeto_id IS 'Clave foránea a la tabla i4_costos_personal.';
COMMENT ON COLUMN cuentas.i4_costos_personal_objeto.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.i4_costos_personal_objeto.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.i4_costos_personal_objeto.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.i4_costos_personal_objeto.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.i4_costos_personal_objeto.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.i4_costos_personal_objeto.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.i4_costos_personal_objeto.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.i4_costos_personal_objeto.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';
COMMENT ON COLUMN cuentas.i4_costos_personal_objeto.especifique IS 'Campo opcional para especificar en caso de moticos sea otros.';


/**************     09/06/2015 *************/

ALTER TABLE cuentas.e_tipos_movimientos
ADD UNIQUE (e_inversion_id, movimiento_id);


ALTER TABLE cuentas.e_tipos_movimientos
DROP CONSTRAINT e_tipos_movimientos_sys_movimiento_id_fkey;
ALTER TABLE cuentas.e_tipos_movimientos
ADD FOREIGN KEY (movimiento_id) REFERENCES cuentas.sys_conceptos (id) ON UPDATE NO ACTION ON DELETE NO ACTION;


COMMENT ON COLUMN cuentas.e_tipos_movimientos.movimiento_id IS 'Clave foránea a la tabla sys_conceptos.';


-- Column: motivo_retiro_id

-- ALTER TABLE cuentas.e_tipos_movimientos DROP COLUMN motivo_retiro_id;

ALTER TABLE cuentas.e_tipos_movimientos ADD COLUMN motivo_retiro_id integer;
COMMENT ON COLUMN cuentas.e_tipos_movimientos.motivo_retiro_id IS 'Clave foránea a la tabla sys_conceptos.';


DROP TABLE cuentas.e_movimientos;


ALTER TABLE cuentas.e_inversiones
DROP COLUMN motivo_retiro;
ALTER TABLE cuentas.e_inversiones
DROP COLUMN fecha_motivo;
ALTER TABLE cuentas.e_inversiones
DROP COLUMN monto_nominal_motivo;
ALTER TABLE cuentas.e_inversiones
DROP COLUMN monto_nominal_motivo_ajus;




ALTER TABLE cuentas.e_inversiones
DROP COLUMN disponibilidad;
ALTER TABLE cuentas.e_inversiones
DROP COLUMN tipo_instrumento;
ALTER TABLE cuentas.e_inversiones
ADD COLUMN disponibilidad_id integer NOT NULL;
ALTER TABLE cuentas.e_inversiones
ADD COLUMN tipo_instrumento_id integer NOT NULL;
COMMENT ON COLUMN cuentas.e_inversiones.disponibilidad_id IS 'Clave foránea a la tabla sys_conceptos. Tipo de disponibilidad de la inversión.';
COMMENT ON COLUMN cuentas.e_inversiones.tipo_instrumento_id IS 'Clave foránea a la tabla sys_conceptos.';


- Table: cuentas.ii3_gastos_funcionamiento

-- DROP TABLE cuentas.ii3_gastos_funcionamiento;

CREATE TABLE cuentas.ii3_gastos_funcionamiento
(
  id integer NOT NULL DEFAULT nextval('cuentas.ii3_gastos_operacionales_id_seq'::regclass), -- Clave primaria.
  concepto_id integer NOT NULL, -- Clave foránea a la tabla sys_conceptos.
  administracion numeric(38,6) NOT NULL, -- Gastos operacionales por administración.
  admin_metodo_id integer NOT NULL, -- Clave foránea a la tabla activos.sys_metodos_mediciones.
  administracion_ajustadas numeric(38,6) NOT NULL, -- Monto administración ajustado.
  ventas numeric(38,6), -- Monto de ventas.
  ventas_metodo_id integer, -- Clave foránea a la tabla activos_sys_metodos_mediciones.
  ventas_ajustadas numeric(38,6), -- Monto de las ventas a justadas.
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT ii3_gastos_operacionales_pkey PRIMARY KEY (id),
  CONSTRAINT ii3_gastos_operacionales_admin_metodo_inflacion_id_fkey FOREIGN KEY (admin_metodo_id)
  REFERENCES activos.sys_metodos_medicion (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT ii3_gastos_operacionales_contratista_id_fkey FOREIGN KEY (contratista_id)
  REFERENCES contratistas (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT ii3_gastos_operacionales_ventas_metodo_inflacion_id_fkey FOREIGN KEY (ventas_metodo_id)
  REFERENCES activos.sys_metodos_medicion (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT ii3_gastos_operacionales_concepto_id_contratista_id_anho_key UNIQUE (concepto_id, contratista_id, anho)
)
WITH (
OIDS=FALSE
);
ALTER TABLE cuentas.ii3_gastos_funcionamiento
OWNER TO eureka;
COMMENT ON TABLE cuentas.ii3_gastos_funcionamiento
IS 'Cuenta II-3 Gastos operacionales o de funcionamiento.';
COMMENT ON COLUMN cuentas.ii3_gastos_funcionamiento.id IS 'Clave primaria.';
COMMENT ON COLUMN cuentas.ii3_gastos_funcionamiento.concepto_id IS 'Clave foránea a la tabla sys_conceptos.';
COMMENT ON COLUMN cuentas.ii3_gastos_funcionamiento.administracion IS 'Gastos operacionales por administración.';
COMMENT ON COLUMN cuentas.ii3_gastos_funcionamiento.admin_metodo_id IS 'Clave foránea a la tabla activos.sys_metodos_mediciones.';
COMMENT ON COLUMN cuentas.ii3_gastos_funcionamiento.administracion_ajustadas IS 'Monto administración ajustado.';
COMMENT ON COLUMN cuentas.ii3_gastos_funcionamiento.ventas IS 'Monto de ventas.';
COMMENT ON COLUMN cuentas.ii3_gastos_funcionamiento.ventas_metodo_id IS 'Clave foránea a la tabla activos_sys_metodos_mediciones.';
COMMENT ON COLUMN cuentas.ii3_gastos_funcionamiento.ventas_ajustadas IS 'Monto de las ventas a justadas.';
COMMENT ON COLUMN cuentas.ii3_gastos_funcionamiento.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.ii3_gastos_funcionamiento.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.ii3_gastos_funcionamiento.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.ii3_gastos_funcionamiento.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.ii3_gastos_funcionamiento.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.ii3_gastos_funcionamiento.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.ii3_gastos_funcionamiento.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.ii3_gastos_funcionamiento.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';





-- Table: cuentas.ii5_tributos

-- DROP TABLE cuentas.ii5_tributos;

CREATE TABLE cuentas.ii5_tributos
(
  id serial NOT NULL, -- Clave primaria.
  concepto_id integer NOT NULL, -- Clave foránea a la  tabla sys_conceptos.
  administracion numeric(38,6) NOT NULL, -- Monto de administracion.
  admin_metodo_id integer NOT NULL, -- Clave foránea  a la tabla activos.sys_metodos_medicion.
  administracion_ajustada numeric(38,6) NOT NULL, -- Monto administración ajustada.
  ventas numeric(38,6), -- Monto Distribución y ventas.
  ventas_metodo_id integer, -- Clave foránea  a la tabla activos.sys_metodos_medicion.
  ventas_ajustadas numeric(38,6), -- Monto de ventas ajustadas.
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT ii5_tributos_pkey PRIMARY KEY (id),
  CONSTRAINT ii5_tributos_concepto_id_fkey FOREIGN KEY (concepto_id)
  REFERENCES cuentas.sys_conceptos (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT ii5_tributos_contratista_id_fkey FOREIGN KEY (contratista_id)
  REFERENCES contratistas (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT ii5_tributos_concepto_id_contratista_id_anho_key UNIQUE (concepto_id, contratista_id, anho)
)
WITH (
OIDS=FALSE
);
ALTER TABLE cuentas.ii5_tributos
OWNER TO eureka;
COMMENT ON TABLE cuentas.ii5_tributos
IS 'Cuenta II-1 - Tributos.';
COMMENT ON COLUMN cuentas.ii5_tributos.id IS 'Clave primaria.';
COMMENT ON COLUMN cuentas.ii5_tributos.concepto_id IS 'Clave foránea a la  tabla sys_conceptos.';
COMMENT ON COLUMN cuentas.ii5_tributos.administracion IS 'Monto de administracion.';
COMMENT ON COLUMN cuentas.ii5_tributos.admin_metodo_id IS 'Clave foránea  a la tabla activos.sys_metodos_medicion.';
COMMENT ON COLUMN cuentas.ii5_tributos.administracion_ajustada IS 'Monto administración ajustada.';
COMMENT ON COLUMN cuentas.ii5_tributos.ventas IS 'Monto Distribución y ventas.';
COMMENT ON COLUMN cuentas.ii5_tributos.ventas_metodo_id IS ' Clave foránea  a la tabla activos.sys_metodos_medicion.';
COMMENT ON COLUMN cuentas.ii5_tributos.ventas_ajustadas IS 'Monto de ventas ajustadas.';
COMMENT ON COLUMN cuentas.ii5_tributos.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.ii5_tributos.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.ii5_tributos.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.ii5_tributos.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.ii5_tributos.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.ii5_tributos.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.ii5_tributos.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.ii5_tributos.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';





-- Table: cuentas.ii2_gastos_personal

-- DROP TABLE cuentas.ii2_gastos_personal;

CREATE TABLE cuentas.ii2_gastos_personal
(
  id serial NOT NULL, -- Clave primaria.
  concepto_id integer NOT NULL, -- Clave foránea a la tabla sys_conceptos.
  administracion numeric(38,6) NOT NULL, -- Gastos operacionales por administración.
  admin_metodo_id integer NOT NULL, -- Clave foránea a la tabla activos.sys_metodos_mediciones.
  administracion_ajustadas numeric(38,6) NOT NULL, -- Monto administración ajustado.
  ventas numeric(38,6), -- Monto de ventas.
  ventas_metodo_id integer, -- Clave foránea a la tabla activos_sys_metodos_mediciones.
  ventas_ajustadas numeric(38,6), -- Monto de las ventas a justadas.
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT ii2_gastos_personal_pkey PRIMARY KEY (id),
  CONSTRAINT ii2_gastos_personal_admin_metodo_inflacion_id_fkey FOREIGN KEY (admin_metodo_id)
  REFERENCES activos.sys_metodos_medicion (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT ii2_gastos_personal_contratista_id_fkey FOREIGN KEY (contratista_id)
  REFERENCES contratistas (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT ii2_gastos_personal_ventas_metodo_inflacion_id_fkey FOREIGN KEY (ventas_metodo_id)
  REFERENCES activos.sys_metodos_medicion (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT ii2_gastos_personal_concepto_id_contratista_id_anho_key UNIQUE (concepto_id, contratista_id, anho)
)
WITH (
OIDS=FALSE
);
ALTER TABLE cuentas.ii2_gastos_personal
OWNER TO eureka;
COMMENT ON TABLE cuentas.ii2_gastos_personal
IS 'Cuenta II-2 Gastos de personal.';
COMMENT ON COLUMN cuentas.ii2_gastos_personal.id IS 'Clave primaria.';
COMMENT ON COLUMN cuentas.ii2_gastos_personal.concepto_id IS 'Clave foránea a la tabla sys_conceptos.';
COMMENT ON COLUMN cuentas.ii2_gastos_personal.administracion IS 'Gastos operacionales por administración.';
COMMENT ON COLUMN cuentas.ii2_gastos_personal.admin_metodo_id IS 'Clave foránea a la tabla activos.sys_metodos_mediciones.';
COMMENT ON COLUMN cuentas.ii2_gastos_personal.administracion_ajustadas IS 'Monto administración ajustado.';
COMMENT ON COLUMN cuentas.ii2_gastos_personal.ventas IS 'Monto de ventas.';
COMMENT ON COLUMN cuentas.ii2_gastos_personal.ventas_metodo_id IS 'Clave foránea a la tabla activos_sys_metodos_mediciones.';
COMMENT ON COLUMN cuentas.ii2_gastos_personal.ventas_ajustadas IS 'Monto de las ventas a justadas.';
COMMENT ON COLUMN cuentas.ii2_gastos_personal.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.ii2_gastos_personal.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.ii2_gastos_personal.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.ii2_gastos_personal.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.ii2_gastos_personal.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.ii2_gastos_personal.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.ii2_gastos_personal.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.ii2_gastos_personal.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';





ALTER TABLE cuentas.ii5_tributos
ADD FOREIGN KEY (admin_metodo_id) REFERENCES activos.sys_metodos_medicion (id) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE cuentas.ii5_tributos
ADD FOREIGN KEY (ventas_metodo_id) REFERENCES activos.sys_metodos_medicion (id) ON UPDATE NO ACTION ON DELETE NO ACTION;


ALTER TABLE cuentas.ii2_gastos_personal
ADD UNIQUE (concepto_id, contratista_id, anho);





/**************     17/06/2015 *************/

-- Table: cuentas.gg_otros_pasivos

-- DROP TABLE cuentas.gg_otros_pasivos;

CREATE TABLE cuentas.gg_otros_pasivos
(
  id serial NOT NULL, -- Clave primaria.
  concepto_id integer NOT NULL, -- Clave foránea a la tabla sys_conceptos.
  partida_monetaria boolean NOT NULL, -- Indica si es partida monetaria o partida no monetaria.
  corriente boolean NOT NULL, -- Corriente o no corriente.
  sys_naturales_juridicas_id integer NOT NULL, -- Referencia o proveedor principal. Clave foránea  a la tabla sys_naturales_juridicas.
  numero_factura_documento character varying(255) NOT NULL, -- Número de factura o documento.
  saldo_periodo_anterior numeric(38,6) NOT NULL, -- Saldo del periodo anterior.
  importe_contratado_periodo numeric(38,6) NOT NULL, -- Importe contratado en el periodo.
  sub_total numeric(38,6), -- Sub total
  metodo_id integer, -- Clave foránea a la tabla sys_metodos_medicion.
  sub_total_ajustado numeric(38,6), -- Sub total ajustado con inflación.
  reintegro numeric(38,6) NOT NULL DEFAULT 0, -- Reintegro.
  metodo_reintegro_id integer, -- Clave foránea a la tabla sys_metodos_medicion.m
  reintegro_ajustado numeric(38,6) DEFAULT 0, -- Reintegro ajustado.
  amortizacion numeric(38,6) NOT NULL DEFAULT 0, -- Amortización.
  metodo_armotizacion_id integer, -- Clave foránea a la tabla sys_metodos_medicion.
  amortizacion_ajustada numeric(38,6) DEFAULT 0, -- Amortizacion ajustada.
  saldo_cierre_ejer numeric(38,6), -- Saldo al cierre del ejercicio económico.
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT gg_otros_pasivos_pkey PRIMARY KEY (id),
  CONSTRAINT gg_otros_pasivos_contratista_id_fkey FOREIGN KEY (contratista_id)
  REFERENCES contratistas (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT gg_otros_pasivos_metodo_armotizacion_id_fkey FOREIGN KEY (metodo_armotizacion_id)
  REFERENCES activos.sys_metodos_medicion (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT gg_otros_pasivos_metodo_id_fkey FOREIGN KEY (metodo_id)
  REFERENCES activos.sys_metodos_medicion (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT gg_otros_pasivos_metodo_reintegro_id_fkey FOREIGN KEY (metodo_reintegro_id)
  REFERENCES activos.sys_metodos_medicion (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT gg_otros_pasivos_concepto_id_partida_monetaria_corriente_co_key UNIQUE (concepto_id, partida_monetaria, corriente, contratista_id, anho)
)
WITH (
OIDS=FALSE
);
ALTER TABLE cuentas.gg_otros_pasivos
OWNER TO eureka;
COMMENT ON TABLE cuentas.gg_otros_pasivos
IS 'Cuenta GG - Otros pasivos.';
COMMENT ON COLUMN cuentas.gg_otros_pasivos.id IS 'Clave primaria.';
COMMENT ON COLUMN cuentas.gg_otros_pasivos.concepto_id IS 'Clave foránea a la tabla sys_conceptos.';
COMMENT ON COLUMN cuentas.gg_otros_pasivos.partida_monetaria IS 'Indica si es partida monetaria o partida no monetaria.';
COMMENT ON COLUMN cuentas.gg_otros_pasivos.corriente IS 'Corriente o no corriente.';
COMMENT ON COLUMN cuentas.gg_otros_pasivos.sys_naturales_juridicas_id IS 'Referencia o proveedor principal. Clave foránea  a la tabla sys_naturales_juridicas.';
COMMENT ON COLUMN cuentas.gg_otros_pasivos.numero_factura_documento IS 'Número de factura o documento.';
COMMENT ON COLUMN cuentas.gg_otros_pasivos.saldo_periodo_anterior IS 'Saldo del periodo anterior.';
COMMENT ON COLUMN cuentas.gg_otros_pasivos.importe_contratado_periodo IS 'Importe contratado en el periodo.';
COMMENT ON COLUMN cuentas.gg_otros_pasivos.sub_total IS 'Sub total';
COMMENT ON COLUMN cuentas.gg_otros_pasivos.metodo_id IS 'Clave foránea a la tabla sys_metodos_medicion.';
COMMENT ON COLUMN cuentas.gg_otros_pasivos.sub_total_ajustado IS 'Sub total ajustado con inflación.';
COMMENT ON COLUMN cuentas.gg_otros_pasivos.reintegro IS 'Reintegro.';
COMMENT ON COLUMN cuentas.gg_otros_pasivos.metodo_reintegro_id IS 'Clave foránea a la tabla sys_metodos_medicion.m';
COMMENT ON COLUMN cuentas.gg_otros_pasivos.reintegro_ajustado IS 'Reintegro ajustado.';
COMMENT ON COLUMN cuentas.gg_otros_pasivos.amortizacion IS 'Amortización.';
COMMENT ON COLUMN cuentas.gg_otros_pasivos.metodo_armotizacion_id IS 'Clave foránea a la tabla sys_metodos_medicion.';
COMMENT ON COLUMN cuentas.gg_otros_pasivos.amortizacion_ajustada IS 'Amortizacion ajustada.';
COMMENT ON COLUMN cuentas.gg_otros_pasivos.saldo_cierre_ejer IS 'Saldo al cierre del ejercicio económico.';
COMMENT ON COLUMN cuentas.gg_otros_pasivos.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.gg_otros_pasivos.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.gg_otros_pasivos.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.gg_otros_pasivos.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.gg_otros_pasivos.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.gg_otros_pasivos.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.gg_otros_pasivos.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.gg_otros_pasivos.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';




ALTER TABLE cuentas.jj_proviciones
RENAME TO jj_provisiones;
COMMENT ON TABLE cuentas.jj_provisiones
IS 'Cuenta HH - Provisiones.';





COMMENT ON COLUMN cuentas.mm2_fondos_reservas.tipo_fondo_reserva_id
IS 'Clave foránea a la tabla sys_conceptos.';
COMMENT ON COLUMN cuentas.mm2_fondos_reservas.descripcion_id
IS 'Clave foránea a la tabla sys_conceptos.';
COMMENT ON COLUMN cuentas.mm2_fondos_reservas.descripcion_apartado_id
IS 'Clave foránea a la tabla sys_conceptos.';
ALTER TABLE cuentas.mm2_fondos_reservas
DROP CONSTRAINT mm2_fondos_reservas_descripcion_apartado_id_fkey;
ALTER TABLE cuentas.mm2_fondos_reservas
DROP CONSTRAINT mm2_fondos_reservas_descripcion_id_fkey;
ALTER TABLE cuentas.mm2_fondos_reservas
DROP CONSTRAINT mm2_fondos_reservas_tipo_fondo_reserva_id_fkey;
ALTER TABLE cuentas.mm2_fondos_reservas
ADD FOREIGN KEY (tipo_fondo_reserva_id) REFERENCES cuentas.sys_conceptos (id) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE cuentas.mm2_fondos_reservas
ADD FOREIGN KEY (descripcion_id) REFERENCES cuentas.sys_conceptos (id) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE cuentas.mm2_fondos_reservas
ADD FOREIGN KEY (descripcion_apartado_id) REFERENCES cuentas.sys_conceptos (id) ON UPDATE NO ACTION ON DELETE NO ACTION;
COMMENT ON COLUMN cuentas.mm2_fondos_reservas.tipo_fondo_reserva_id IS 'Clave foránea a la tabla sys_conceptos.';
COMMENT ON COLUMN cuentas.mm2_fondos_reservas.descripcion_id IS 'Clave foránea a la tabla sys_conceptos.';
COMMENT ON COLUMN cuentas.mm2_fondos_reservas.descripcion_apartado_id IS 'Clave foránea a la tabla sys_conceptos.';


DROP TABLE cuentas.mm2_descripciones;

DROP TABLE cuentas.mm2_tipos_fondos_reservas;


COMMENT ON COLUMN cuentas.mm1_resacum_ajus_correc.ajuste_corre_reval_id
IS 'Clave foránea a la tabla sys_conceptos.';
ALTER TABLE cuentas.mm1_resacum_ajus_correc
DROP CONSTRAINT mm1_resacum_ajus_correc_ajuste_corre_reval_id_fkey;
ALTER TABLE cuentas.mm1_resacum_ajus_correc
ADD FOREIGN KEY (ajuste_corre_reval_id) REFERENCES cuentas.sys_conceptos (id) ON UPDATE NO ACTION ON DELETE NO ACTION;
COMMENT ON COLUMN cuentas.mm1_resacum_ajus_correc.ajuste_corre_reval_id IS 'Clave foránea a la tabla sys_conceptos.';


DROP TABLE cuentas.mm1_ajustes_correciones_revals;



-- Table: cuentas.mm3_otros_resultados_integrales

-- DROP TABLE cuentas.mm3_otros_resultados_integrales;

CREATE TABLE cuentas.mm3_otros_resultados_integrales
(
  id serial NOT NULL, -- Clave primaria.
  cuentas_id integer NOT NULL, -- Clave foránea a la tabla sys_conceptos.
  monto_historico numeric(38,6) NOT NULL, -- Monto histórico.
  otro_especificar character varying(255), -- En caso de que la cuenta elegida sea Otro: especificiar.
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT mm3_otros_resultados_integrales_pkey PRIMARY KEY (id),
  CONSTRAINT mm3_otros_resultados_integrales_contratista_id_fkey FOREIGN KEY (contratista_id)
  REFERENCES contratistas (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT mm3_otros_resultados_integrales_cuentas_id_fkey FOREIGN KEY (cuentas_id)
  REFERENCES cuentas.sys_conceptos (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT mm3_otros_resultados_integral_cuentas_id_otro_especificar_c_key UNIQUE (cuentas_id, otro_especificar, contratista_id, anho)
)
WITH (
OIDS=FALSE
);
ALTER TABLE cuentas.mm3_otros_resultados_integrales
OWNER TO eureka;
COMMENT ON TABLE cuentas.mm3_otros_resultados_integrales
IS 'Cuenta MM3 - Otros Resultados integrales.';
COMMENT ON COLUMN cuentas.mm3_otros_resultados_integrales.id IS 'Clave primaria.';
COMMENT ON COLUMN cuentas.mm3_otros_resultados_integrales.cuentas_id IS 'Clave foránea a la tabla sys_conceptos.';
COMMENT ON COLUMN cuentas.mm3_otros_resultados_integrales.monto_historico IS 'Monto histórico.';
COMMENT ON COLUMN cuentas.mm3_otros_resultados_integrales.otro_especificar IS 'En caso de que la cuenta elegida sea Otro: especificiar.';
COMMENT ON COLUMN cuentas.mm3_otros_resultados_integrales.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.mm3_otros_resultados_integrales.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.mm3_otros_resultados_integrales.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.mm3_otros_resultados_integrales.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.mm3_otros_resultados_integrales.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.mm3_otros_resultados_integrales.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.mm3_otros_resultados_integrales.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.mm3_otros_resultados_integrales.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';




-- Table: cuentas.mm1_resacum_ajus_correc

DROP TABLE cuentas.mm1_resacum_ajus_correc;

CREATE TABLE cuentas.mm1_resacum_ajus_correc
(
  id serial NOT NULL, -- Clave primaria.
  resultado_acumulado_id integer NOT NULL, -- Clave foránea a la tabla mm1_resultados_acumulados.
  ajuste_corre_reval_id integer NOT NULL, -- Clave foránea a la tabla sys_conceptos.
  fecha_inicio date NOT NULL, -- Fecha (INICIO)
  monto_aum_dis numeric(38,6) NOT NULL, -- Monto de aumentos y disminuciones.
  monto_ajustado_aum_dis numeric(38,6) NOT NULL,
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT mm1_resacum_ajus_correc_pkey PRIMARY KEY (id),
  CONSTRAINT mm1_resacum_ajus_correc_ajuste_corre_reval_id_fkey FOREIGN KEY (ajuste_corre_reval_id)
  REFERENCES cuentas.sys_conceptos (id) MATCH SIMPLE
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
COMMENT ON COLUMN cuentas.mm1_resacum_ajus_correc.ajuste_corre_reval_id IS 'Clave foránea a la tabla sys_conceptos.';
COMMENT ON COLUMN cuentas.mm1_resacum_ajus_correc.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.mm1_resacum_ajus_correc.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.mm1_resacum_ajus_correc.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.mm1_resacum_ajus_correc.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.mm1_resacum_ajus_correc.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.mm1_resacum_ajus_correc.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';
COMMENT ON COLUMN cuentas.mm1_resacum_ajus_correc.fecha_inicio IS 'Fecha (INICIO)';
COMMENT ON COLUMN cuentas.mm1_resacum_ajus_correc.monto_aum_dis IS 'Monto de aumentos y disminuciones.';
COMMENT ON COLUMN cuentas.mm1_resacum_ajus_correc.monto_ajustado_aum_dis IS 'Monto Ajustado aumentos y disminuciones.';


ALTER TABLE cuentas.mm1_resultados_acumulados
DROP COLUMN fecha_inicio;
ALTER TABLE cuentas.mm1_resultados_acumulados
DROP COLUMN monto_aum_dis;
ALTER TABLE cuentas.mm1_resultados_acumulados
DROP COLUMN monto_ajustado_aum_dis;







/**************     18/06/2015 *************/


-- Table: cuentas.i5_depreciacion_amortizacion_produccion

-- DROP TABLE cuentas.i5_depreciacion_amortizacion_produccion;

CREATE TABLE cuentas.i5_depreciacion_amortizacion_produccion
(
  id serial NOT NULL, -- Clave primaria.
  concepto_id integer NOT NULL, -- Clave foránea a la tabla sys_conceptos.
  directo_historico numeric(38,6) NOT NULL DEFAULT 0, -- Costo directo de producción histórico.
  directo_ajustado numeric(38,6) NOT NULL DEFAULT 0, -- Costo directo de producción ajustado.
  indirecto_historico numeric(38,6) NOT NULL DEFAULT 0, -- Costo indirecto de producción histórico.
  indirecto_ajustado numeric(38,6) NOT NULL DEFAULT 0, -- Costo indirecto de producción ajustado.
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT i5_depreciacion_amortizacion_produccion_pkey PRIMARY KEY (id),
  CONSTRAINT i5_depreciacion_amortizacion_produccion_concepto_id_fkey FOREIGN KEY (concepto_id)
  REFERENCES cuentas.sys_conceptos (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT i5_depreciacion_amortizacion_produccion_contratista_id_fkey FOREIGN KEY (contratista_id)
  REFERENCES contratistas (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT i5_depreciacion_amortizacion_produccion_concepto_id_contratista UNIQUE (concepto_id, contratista_id, anho)
)
WITH (
OIDS=FALSE
);
ALTER TABLE cuentas.i5_depreciacion_amortizacion_produccion
OWNER TO eureka;
COMMENT ON TABLE cuentas.i5_depreciacion_amortizacion_produccion
IS 'Cuenta I5 - Depreciación y amortización (Solo para empresas de producción)';
COMMENT ON COLUMN cuentas.i5_depreciacion_amortizacion_produccion.id IS 'Clave primaria.';
COMMENT ON COLUMN cuentas.i5_depreciacion_amortizacion_produccion.concepto_id IS 'Clave foránea a la tabla sys_conceptos.';
COMMENT ON COLUMN cuentas.i5_depreciacion_amortizacion_produccion.directo_historico IS 'Costo directo de producción histórico.';
COMMENT ON COLUMN cuentas.i5_depreciacion_amortizacion_produccion.directo_ajustado IS 'Costo directo de producción ajustado.';
COMMENT ON COLUMN cuentas.i5_depreciacion_amortizacion_produccion.indirecto_historico IS 'Costo indirecto de producción histórico.';
COMMENT ON COLUMN cuentas.i5_depreciacion_amortizacion_produccion.indirecto_ajustado IS 'Costo indirecto de producción ajustado.';
COMMENT ON COLUMN cuentas.i5_depreciacion_amortizacion_produccion.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.i5_depreciacion_amortizacion_produccion.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.i5_depreciacion_amortizacion_produccion.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.i5_depreciacion_amortizacion_produccion.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.i5_depreciacion_amortizacion_produccion.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.i5_depreciacion_amortizacion_produccion.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.i5_depreciacion_amortizacion_produccion.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.i5_depreciacion_amortizacion_produccion.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';







-- Table: cuentas.ii4_depreciacion_amortizacion

--DROP TABLE cuentas.ii4_depreciacion_amortizacion;

CREATE TABLE cuentas.ii4_depreciacion_amortizacion
(
  id serial NOT NULL, -- Clave primaria.
  concepto_id integer NOT NULL, -- Clave foránea a la tabla sys_conceptos.
  distribucion_ventas numeric(38,6) NOT NULL DEFAULT 0, -- Costo directo de producción histórico.
  administracion numeric(38,6) NOT NULL DEFAULT 0, -- Costo directo de producción ajustado.
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT i5_depreciacion_armortizacion_pkey PRIMARY KEY (id),
  CONSTRAINT i5_depreciacion_armortizacion_concepto_id_fkey FOREIGN KEY (concepto_id)
  REFERENCES cuentas.sys_conceptos (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT i5_depreciacion_armortizacion_contratista_id_fkey FOREIGN KEY (contratista_id)
  REFERENCES contratistas (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT i5_depreciacion_armortizacion_concepto_id_contratista_id_anh_key UNIQUE (concepto_id, contratista_id, anho)
)
WITH (
OIDS=FALSE
);
ALTER TABLE cuentas.ii4_depreciacion_amortizacion
OWNER TO eureka;
COMMENT ON TABLE cuentas.ii4_depreciacion_amortizacion
IS 'Cuenta I5 - Depreciación y amortización (Solo para empresas de producción)';
COMMENT ON COLUMN cuentas.ii4_depreciacion_amortizacion.id IS 'Clave primaria.';
COMMENT ON COLUMN cuentas.ii4_depreciacion_amortizacion.concepto_id IS 'Clave foránea a la tabla sys_conceptos.';
COMMENT ON COLUMN cuentas.ii4_depreciacion_amortizacion.distribucion_ventas IS 'Distribución y ventas.';
COMMENT ON COLUMN cuentas.ii4_depreciacion_amortizacion.administracion IS 'Administración.';
COMMENT ON COLUMN cuentas.ii4_depreciacion_amortizacion.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.ii4_depreciacion_amortizacion.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.ii4_depreciacion_amortizacion.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.ii4_depreciacion_amortizacion.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.ii4_depreciacion_amortizacion.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.ii4_depreciacion_amortizacion.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.ii4_depreciacion_amortizacion.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.ii4_depreciacion_amortizacion.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';



-- Table: cuentas.i1_ingresos_operacionales

-- DROP TABLE cuentas.i1_ingresos_operacionales;

CREATE TABLE cuentas.i1_ingresos_operacionales
(
  id serial NOT NULL, -- Clave primaria.
  sector_publico numeric(38,6) NOT NULL DEFAULT 0, -- Sector Público.
  metodo_publico_id integer NOT NULL, -- Clave foránea a la tabla sys_metodos_medicion.
  monto_publico_ajustado numeric(38,6) NOT NULL, -- Monto público ajustado.
  sector_privado numeric(38,6) NOT NULL DEFAULT 0, -- Sector privado.
  metodo_privado_id integer NOT NULL, -- Clave foránea a la tabla sys_metodos_medicion.
  monto_privado_ajustado numeric(38,6) NOT NULL DEFAULT 0, -- Monto privado ajustado.
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT i1_ingresos_operacionales_pkey PRIMARY KEY (id),
  CONSTRAINT i1_ingresos_operacionales_contratista_id_fkey FOREIGN KEY (contratista_id)
  REFERENCES contratistas (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT i1_ingresos_operacionales_contratista_id_anho_key UNIQUE (contratista_id, anho)
)
WITH (
OIDS=FALSE
);
ALTER TABLE cuentas.i1_ingresos_operacionales
OWNER TO eureka;
COMMENT ON TABLE cuentas.i1_ingresos_operacionales
IS 'Cuenta  I1 - Ingresos operacionales.';
COMMENT ON COLUMN cuentas.i1_ingresos_operacionales.id IS 'Clave primaria.';
COMMENT ON COLUMN cuentas.i1_ingresos_operacionales.sector_publico IS 'Sector Público.';
COMMENT ON COLUMN cuentas.i1_ingresos_operacionales.metodo_publico_id IS 'Clave foránea a la tabla sys_metodos_medicion.';
COMMENT ON COLUMN cuentas.i1_ingresos_operacionales.monto_publico_ajustado IS 'Monto público ajustado.';
COMMENT ON COLUMN cuentas.i1_ingresos_operacionales.sector_privado IS 'Sector privado.';
COMMENT ON COLUMN cuentas.i1_ingresos_operacionales.metodo_privado_id IS 'Clave foránea a la tabla sys_metodos_medicion.';
COMMENT ON COLUMN cuentas.i1_ingresos_operacionales.monto_privado_ajustado IS 'Monto privado ajustado.';
COMMENT ON COLUMN cuentas.i1_ingresos_operacionales.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.i1_ingresos_operacionales.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.i1_ingresos_operacionales.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.i1_ingresos_operacionales.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.i1_ingresos_operacionales.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.i1_ingresos_operacionales.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.i1_ingresos_operacionales.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.i1_ingresos_operacionales.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';



-- Table: cuentas.iv1_ingresos_egresos_financieros

-- DROP TABLE cuentas.iv1_ingresos_egresos_financieros;

CREATE TABLE cuentas.iv1_ingresos_egresos_financieros
(
  id serial NOT NULL, -- Clave primaria.
  ganados_pagados boolean NOT NULL, -- Intereses Ganados o pagados.
  concepto_id integer NOT NULL, -- Clave foránea a la tabla sys_conceptos.
  monto_historico numeric(38,6) NOT NULL, -- Monto histórico.
  metodo_id integer NOT NULL, -- Clave foránea a la tabla sys_metodos_medicion.
  monto_ajustado numeric(38,6) NOT NULL DEFAULT 0, -- Monto Ajuistado.
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT iv1_ingresos_egresos_financieros_pkey PRIMARY KEY (id),
  CONSTRAINT iv1_ingresos_egresos_financieros_contratista_id_fkey FOREIGN KEY (contratista_id)
  REFERENCES contratistas (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT iv1_ingresos_egresos_financie_concepto_id_ganados_pagados_a_key UNIQUE (concepto_id, ganados_pagados, anho, contratista_id)
)
WITH (
OIDS=FALSE
);
ALTER TABLE cuentas.iv1_ingresos_egresos_financieros
OWNER TO eureka;
COMMENT ON TABLE cuentas.iv1_ingresos_egresos_financieros
IS 'Cuenta IV4 - Beneficio o (Costo) de financiamiento.';
COMMENT ON COLUMN cuentas.iv1_ingresos_egresos_financieros.id IS 'Clave primaria.';
COMMENT ON COLUMN cuentas.iv1_ingresos_egresos_financieros.ganados_pagados IS 'Intereses Ganados o pagados.';
COMMENT ON COLUMN cuentas.iv1_ingresos_egresos_financieros.concepto_id IS 'Clave foránea a la tabla sys_conceptos.';
COMMENT ON COLUMN cuentas.iv1_ingresos_egresos_financieros.monto_historico IS 'Monto histórico.';
COMMENT ON COLUMN cuentas.iv1_ingresos_egresos_financieros.metodo_id IS 'Clave foránea a la tabla sys_metodos_medicion.';
COMMENT ON COLUMN cuentas.iv1_ingresos_egresos_financieros.monto_ajustado IS 'Monto Ajuistado.';
COMMENT ON COLUMN cuentas.iv1_ingresos_egresos_financieros.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.iv1_ingresos_egresos_financieros.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.iv1_ingresos_egresos_financieros.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.iv1_ingresos_egresos_financieros.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.iv1_ingresos_egresos_financieros.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.iv1_ingresos_egresos_financieros.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.iv1_ingresos_egresos_financieros.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.iv1_ingresos_egresos_financieros.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';




-- Table: cuentas.iv1_diferencial_cambiario

-- DROP TABLE cuentas.iv1_diferencial_cambiario;

CREATE TABLE cuentas.iv1_diferencial_cambiario
(
  id serial NOT NULL, -- Clave primaria.
  moneda_origen_id integer NOT NULL, -- Clave foránea  a la tabla public.sys_divisas.
  origen_fondos_id integer NOT NULL, -- Calve foránea  a la tabla sys_conceptos.
  monto_divisa numeric(38,6) NOT NULL, -- Monto en moneda extranjera.
  tasa_cambio_adquisicion numeric(38,6) NOT NULL, -- Tasa de cambio adquisición.
  costo_adquisicion numeric(38,6) NOT NULL, -- Costo de adqusición (Bs.).
  tasa_cambio_venta numeric(38,6) NOT NULL, -- Tasa de cambio para la venta.
  costo_venta numeric(38,6) NOT NULL, -- Costo de venta.
  ganancia_perdida numeric(38,6) NOT NULL, -- Ganancia o perdida.
  metodo_id integer NOT NULL, -- Clave foránea a la tabla activos.sys_metodos_medicion.
  monto_ajustado numeric(38,6), -- Monto ajustado.
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT iv4_diferencial_cambiario_pkey PRIMARY KEY (id),
  CONSTRAINT iv1_diferencial_cambiario_contratista_id_fkey FOREIGN KEY (contratista_id)
  REFERENCES contratistas (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT iv4_diferencial_cambiario_metodo_id_fkey FOREIGN KEY (metodo_id)
  REFERENCES activos.sys_metodos_medicion (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT iv1_diferencial_cambiario_moneda_origen_id_origen_fondos_id_key UNIQUE (moneda_origen_id, origen_fondos_id, contratista_id, anho)
)
WITH (
OIDS=FALSE
);
ALTER TABLE cuentas.iv1_diferencial_cambiario
OWNER TO eureka;
COMMENT ON TABLE cuentas.iv1_diferencial_cambiario
IS 'Cuenta IV4 - Diferencial cambiario.';
COMMENT ON COLUMN cuentas.iv1_diferencial_cambiario.id IS 'Clave primaria.';
COMMENT ON COLUMN cuentas.iv1_diferencial_cambiario.moneda_origen_id IS 'Clave foránea  a la tabla public.sys_divisas.';
COMMENT ON COLUMN cuentas.iv1_diferencial_cambiario.origen_fondos_id IS 'Calve foránea  a la tabla sys_conceptos.';
COMMENT ON COLUMN cuentas.iv1_diferencial_cambiario.monto_divisa IS 'Monto en moneda extranjera.';
COMMENT ON COLUMN cuentas.iv1_diferencial_cambiario.tasa_cambio_adquisicion IS 'Tasa de cambio adquisición.';
COMMENT ON COLUMN cuentas.iv1_diferencial_cambiario.costo_adquisicion IS 'Costo de adqusición (Bs.).';
COMMENT ON COLUMN cuentas.iv1_diferencial_cambiario.tasa_cambio_venta IS 'Tasa de cambio para la venta.';
COMMENT ON COLUMN cuentas.iv1_diferencial_cambiario.costo_venta IS 'Costo de venta.';
COMMENT ON COLUMN cuentas.iv1_diferencial_cambiario.ganancia_perdida IS 'Ganancia o perdida.';
COMMENT ON COLUMN cuentas.iv1_diferencial_cambiario.metodo_id IS 'Clave foránea a la tabla activos.sys_metodos_medicion.';
COMMENT ON COLUMN cuentas.iv1_diferencial_cambiario.monto_ajustado IS 'Monto ajustado.';
COMMENT ON COLUMN cuentas.iv1_diferencial_cambiario.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.iv1_diferencial_cambiario.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.iv1_diferencial_cambiario.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.iv1_diferencial_cambiario.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.iv1_diferencial_cambiario.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.iv1_diferencial_cambiario.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.iv1_diferencial_cambiario.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.iv1_diferencial_cambiario.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';




-- Table: cuentas.iv2_ganancia_perdida_posicion

-- DROP TABLE cuentas.iv2_ganancia_perdida_posicion;

CREATE TABLE cuentas.iv2_ganancia_perdida_posicion
(
  id serial NOT NULL, -- Clave primaria.
  concepto_id integer NOT NULL, -- Clave foránea a la tabla sys_conceptos.
  cifras_historicas numeric(38,6) NOT NULL, -- Cigras históricas.
  cifras_ajustadas numeric(38,6) NOT NULL, -- Cifras ajustadas.
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT iv2_ganancia_perdida_posicion_pkey PRIMARY KEY (id),
  CONSTRAINT iv2_ganancia_perdida_posicion_concepto_id_fkey FOREIGN KEY (concepto_id)
  REFERENCES cuentas.sys_conceptos (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT iv2_ganancia_perdida_posicion_contratista_id_fkey FOREIGN KEY (contratista_id)
  REFERENCES contratistas (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT iv2_ganancia_perdida_posicion_concepto_id_contratista_id_an_key UNIQUE (concepto_id, contratista_id, anho)
)
WITH (
OIDS=FALSE
);
ALTER TABLE cuentas.iv2_ganancia_perdida_posicion
OWNER TO eureka;
COMMENT ON TABLE cuentas.iv2_ganancia_perdida_posicion
IS 'Cuenta IV2 - Ganancia o (pérdida) en la posición.';
COMMENT ON COLUMN cuentas.iv2_ganancia_perdida_posicion.id IS 'Clave primaria.';
COMMENT ON COLUMN cuentas.iv2_ganancia_perdida_posicion.concepto_id IS 'Clave foránea a la tabla sys_conceptos.';
COMMENT ON COLUMN cuentas.iv2_ganancia_perdida_posicion.cifras_historicas IS 'Cigras históricas.';
COMMENT ON COLUMN cuentas.iv2_ganancia_perdida_posicion.cifras_ajustadas IS 'Cifras ajustadas.';
COMMENT ON COLUMN cuentas.iv2_ganancia_perdida_posicion.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.iv2_ganancia_perdida_posicion.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.iv2_ganancia_perdida_posicion.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.iv2_ganancia_perdida_posicion.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.iv2_ganancia_perdida_posicion.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.iv2_ganancia_perdida_posicion.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.iv2_ganancia_perdida_posicion.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.iv2_ganancia_perdida_posicion.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';




-- Table: cuentas.g_otros_activos

-- DROP TABLE cuentas.g_otros_activos;

CREATE TABLE cuentas.g_otros_activos
(
  id serial NOT NULL, -- Clave primaria.
  concepto_id integer NOT NULL, -- Clave foránea a la tabla sys_conceptos.
  partida_monetaria boolean NOT NULL, -- Indica si es partida monetaria o no monetaria.
  corriente boolean NOT NULL, -- Indica si es corriente o no corriente.
  proveedor_id integer NOT NULL, -- Clave foránea a la tabla sys_naturales_juridicas.
  num_factura_contrato character varying(255) NOT NULL, -- Número de factura o contrato.
  saldo_periodo_anterior numeric(38,6) NOT NULL, -- Saldo periodo anterior  (A la moneda de ese cierre).
  saldo_per_ant_actual numeric(38,6) DEFAULT 0, -- Saldo del Período Anterior (Ajustado a moneda actual). Este ajuste solo aplica para NO MONETARIAS
  importe_contratdo_ejercicio numeric(38,6) NOT NULL, -- Importe Contratado en el Ejercicio Económico.
  metodo_subtotal_id integer, -- Clave foránea a la tabla activos.sys_metodos_medicion.  Este ajuste solo aplica para NO MONETARIAS
  subtotal_ajustado numeric(38,6), -- Subtotal Ajustado. Este ajuste solo aplica para NO MONETARIAS
  subtotal numeric(38,6) DEFAULT 0, -- Sub-total
  reintegro numeric(38,6) NOT NULL DEFAULT 0, -- Reintegro.
  metodo_reintegro_id integer, -- Clave foránea a la tabla activos.sys_metodos_medicion. Activar solo si el reintegro es Diferente de 0
  reintegro_ajustado numeric(38,6) DEFAULT 0, -- Rentegro ajustado. Activar solo si el reintegro es Diferente de 0
  amortizacion numeric(38,6) NOT NULL DEFAULT 0, -- Amortizacion.
  metodo_amortizacion_id integer, -- Clave foránea a la tabla activos.sys_metodos_medicion. Activar solo si la amorización es Diferente de 0
  amortizacion_ajustada numeric(38,6), -- Amortización ajustada.  Activar solo si la amorización es Diferente de 0
  saldo_cierre_ejercicio numeric(38,6) NOT NULL DEFAULT 0, -- Saldo al cierre del ejercicion económico.
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT g_otros_activos_pkey PRIMARY KEY (id),
  CONSTRAINT g_otros_activos_concepto_id_fkey FOREIGN KEY (concepto_id)
  REFERENCES cuentas.sys_conceptos (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT g_otros_activos_contratista_id_fkey FOREIGN KEY (contratista_id)
  REFERENCES contratistas (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT g_otros_activos_metodo_amortizacion_id_fkey FOREIGN KEY (metodo_amortizacion_id)
  REFERENCES activos.sys_metodos_medicion (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT g_otros_activos_metodo_reintegro_id_fkey FOREIGN KEY (metodo_reintegro_id)
  REFERENCES activos.sys_metodos_medicion (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT g_otros_activos_metodo_subtotal_id_fkey FOREIGN KEY (metodo_subtotal_id)
  REFERENCES activos.sys_metodos_medicion (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT g_otros_activos_proveedor_id_fkey FOREIGN KEY (proveedor_id)
  REFERENCES sys_naturales_juridicas (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT g_otros_activos_concepto_id_partida_monetaria_corriente_con_key UNIQUE (concepto_id, partida_monetaria, corriente, contratista_id, anho)
)
WITH (
OIDS=FALSE
);
ALTER TABLE cuentas.g_otros_activos
OWNER TO eureka;
COMMENT ON TABLE cuentas.g_otros_activos
IS 'Cuenta G - Otros activos';
COMMENT ON COLUMN cuentas.g_otros_activos.id IS 'Clave primaria.';
COMMENT ON COLUMN cuentas.g_otros_activos.concepto_id IS 'Clave foránea a la tabla sys_conceptos.';
COMMENT ON COLUMN cuentas.g_otros_activos.partida_monetaria IS 'Indica si es partida monetaria o no monetaria.';
COMMENT ON COLUMN cuentas.g_otros_activos.corriente IS 'Indica si es corriente o no corriente.';
COMMENT ON COLUMN cuentas.g_otros_activos.proveedor_id IS 'Clave foránea a la tabla sys_naturales_juridicas.';
COMMENT ON COLUMN cuentas.g_otros_activos.num_factura_contrato IS 'Número de factura o contrato.';
COMMENT ON COLUMN cuentas.g_otros_activos.saldo_periodo_anterior IS 'Saldo periodo anterior  (A la moneda de ese cierre).';
COMMENT ON COLUMN cuentas.g_otros_activos.saldo_per_ant_actual IS 'Saldo del Período Anterior (Ajustado a moneda actual). Este ajuste solo aplica para NO MONETARIAS';
COMMENT ON COLUMN cuentas.g_otros_activos.importe_contratdo_ejercicio IS 'Importe Contratado en el Ejercicio Económico.';
COMMENT ON COLUMN cuentas.g_otros_activos.metodo_subtotal_id IS 'Clave foránea a la tabla activos.sys_metodos_medicion.  Este ajuste solo aplica para NO MONETARIAS';
COMMENT ON COLUMN cuentas.g_otros_activos.subtotal_ajustado IS 'Subtotal Ajustado. Este ajuste solo aplica para NO MONETARIAS';
COMMENT ON COLUMN cuentas.g_otros_activos.subtotal IS 'Sub-total';
COMMENT ON COLUMN cuentas.g_otros_activos.reintegro IS 'Reintegro.';
COMMENT ON COLUMN cuentas.g_otros_activos.metodo_reintegro_id IS 'Clave foránea a la tabla activos.sys_metodos_medicion. Activar solo si el reintegro es Diferente de 0';
COMMENT ON COLUMN cuentas.g_otros_activos.reintegro_ajustado IS 'Rentegro ajustado. Activar solo si el reintegro es Diferente de 0';
COMMENT ON COLUMN cuentas.g_otros_activos.amortizacion IS 'Amortizacion.';
COMMENT ON COLUMN cuentas.g_otros_activos.metodo_amortizacion_id IS 'Clave foránea a la tabla activos.sys_metodos_medicion. Activar solo si la amorización es Diferente de 0';
COMMENT ON COLUMN cuentas.g_otros_activos.amortizacion_ajustada IS 'Amortización ajustada.  Activar solo si la amorización es Diferente de 0';
COMMENT ON COLUMN cuentas.g_otros_activos.saldo_cierre_ejercicio IS 'Saldo al cierre del ejercicion económico.';
COMMENT ON COLUMN cuentas.g_otros_activos.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.g_otros_activos.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.g_otros_activos.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.g_otros_activos.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.g_otros_activos.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.g_otros_activos.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.g_otros_activos.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.g_otros_activos.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';






-- Table: cuentas.dd1_conciliacion_fiscal_rentas

-- DROP TABLE cuentas.dd1_conciliacion_fiscal_rentas;

CREATE TABLE cuentas.dd1_conciliacion_fiscal_rentas
(
  id serial NOT NULL, -- Clave primaria.
  concepto_id integer NOT NULL, -- Clave foránea  a la tabla sys_conceptos.
  monto numeric(38,6), -- Monto correspondiente al concepto para el año de carga en curso.
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT dd1_conciliacion_fiscal_rentas_pkey PRIMARY KEY (id),
  CONSTRAINT dd1_conciliacion_fiscal_rentas_concepto_id_fkey FOREIGN KEY (concepto_id)
  REFERENCES cuentas.sys_conceptos (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT dd1_conciliacion_fiscal_rentas_contratista_id_fkey FOREIGN KEY (contratista_id)
  REFERENCES contratistas (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT dd1_conciliacion_fiscal_renta_concepto_id_contratista_id_an_key UNIQUE (concepto_id, contratista_id, anho)
)
WITH (
OIDS=FALSE
);
ALTER TABLE cuentas.dd1_conciliacion_fiscal_rentas
OWNER TO eureka;
COMMENT ON TABLE cuentas.dd1_conciliacion_fiscal_rentas
IS 'Cuenta DD1 - Conciliación Fiscal de Rentas.';
COMMENT ON COLUMN cuentas.dd1_conciliacion_fiscal_rentas.id IS 'Clave primaria.';
COMMENT ON COLUMN cuentas.dd1_conciliacion_fiscal_rentas.concepto_id IS 'Clave foránea  a la tabla sys_conceptos.';
COMMENT ON COLUMN cuentas.dd1_conciliacion_fiscal_rentas.monto IS 'Monto correspondiente al concepto para el año de carga en curso.';
COMMENT ON COLUMN cuentas.dd1_conciliacion_fiscal_rentas.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.dd1_conciliacion_fiscal_rentas.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.dd1_conciliacion_fiscal_rentas.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.dd1_conciliacion_fiscal_rentas.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.dd1_conciliacion_fiscal_rentas.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.dd1_conciliacion_fiscal_rentas.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.dd1_conciliacion_fiscal_rentas.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.dd1_conciliacion_fiscal_rentas.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';




-- Table: cuentas.dd2_islr_diferido

-- DROP TABLE cuentas.dd2_islr_diferido;

CREATE TABLE cuentas.dd2_islr_diferido
(
  id serial NOT NULL, -- Clave primaria.
  concepto_id integer NOT NULL, -- Clave foránea a la tabla sys_conceptos.
  base_financiera numeric(38,6) NOT NULL, -- Base financiera.
  base_fiscal numeric(38,6) NOT NULL, -- Base fiscal.
  diferencia_temporaria numeric(38,6) NOT NULL, -- Diferencia temporaria.
  activo_impuesto_diferido numeric(38,6) NOT NULL DEFAULT 0, -- Activo impuesto diferido 15%.
  pasivo_impuesto_diferido numeric(38,6) NOT NULL DEFAULT 0, -- Pasivo impuesto diferido 15%.
  contratista_id integer NOT NULL, -- Clave foranea al contratista
  anho character varying(100) NOT NULL, -- Año contable y mes
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT dd2_islr_diferido_pkey PRIMARY KEY (id),
  CONSTRAINT dd2_islr_diferido_concepto_id_fkey FOREIGN KEY (concepto_id)
  REFERENCES cuentas.sys_conceptos (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT dd2_islr_diferido_contratista_id_fkey FOREIGN KEY (contratista_id)
  REFERENCES contratistas (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT dd2_islr_diferido_concepto_id_contratista_id_anho_key UNIQUE (concepto_id, contratista_id, anho)
)
WITH (
OIDS=FALSE
);
ALTER TABLE cuentas.dd2_islr_diferido
OWNER TO eureka;
COMMENT ON TABLE cuentas.dd2_islr_diferido
IS 'Cuenta DD2 - Impuesto sobre la renta diferido.';
COMMENT ON COLUMN cuentas.dd2_islr_diferido.id IS 'Clave primaria.';
COMMENT ON COLUMN cuentas.dd2_islr_diferido.concepto_id IS 'Clave foránea a la tabla sys_conceptos.';
COMMENT ON COLUMN cuentas.dd2_islr_diferido.base_financiera IS 'Base financiera.';
COMMENT ON COLUMN cuentas.dd2_islr_diferido.base_fiscal IS 'Base fiscal.';
COMMENT ON COLUMN cuentas.dd2_islr_diferido.diferencia_temporaria IS 'Diferencia temporaria.';
COMMENT ON COLUMN cuentas.dd2_islr_diferido.activo_impuesto_diferido IS 'Activo impuesto diferido 15%.';
COMMENT ON COLUMN cuentas.dd2_islr_diferido.pasivo_impuesto_diferido IS 'Pasivo impuesto diferido 15%.';
COMMENT ON COLUMN cuentas.dd2_islr_diferido.contratista_id IS 'Clave foranea al contratista';
COMMENT ON COLUMN cuentas.dd2_islr_diferido.anho IS 'Año contable y mes';
COMMENT ON COLUMN cuentas.dd2_islr_diferido.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.dd2_islr_diferido.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN cuentas.dd2_islr_diferido.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN cuentas.dd2_islr_diferido.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN cuentas.dd2_islr_diferido.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN cuentas.dd2_islr_diferido.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';



ALTER TABLE cuentas.dd3_otros_tributos
ADD UNIQUE (concepto_id, contratista_id, anho);
