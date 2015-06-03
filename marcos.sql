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

