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



