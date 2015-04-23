CREATE TYPE tipo_moneda_enum AS ENUM ('Nacional', 'Extranjera');

ALTER TABLE nombres_cajas ADD COLUMN tipo_caja tipo_moneda_enum;
ALTER TABLE nombres_cajas ALTER COLUMN tipo_caja SET NOT NULL;
COMMENT ON COLUMN nombres_cajas.tipo_caja IS 'Valor que indica si la caja fue creada para moneda nacional o extranjera';


-- Foreign Key: sys_naturales_juridicas_rif_fkey

 ALTER TABLE sys_naturales_juridicas DROP CONSTRAINT sys_naturales_juridicas_rif_fkey;

      -- Foreign Key: sys_naturales_juridicas_rif_fkey1

 ALTER TABLE sys_naturales_juridicas DROP CONSTRAINT sys_naturales_juridicas_rif_fkey1;



-- Foreign Key: personas_juridicas_rif_fkey

-- ALTER TABLE personas_juridicas DROP CONSTRAINT personas_juridicas_rif_fkey;

ALTER TABLE personas_juridicas
  ADD CONSTRAINT personas_juridicas_rif_fkey FOREIGN KEY (rif)
      REFERENCES sys_naturales_juridicas (rif) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION;

  -- Foreign Key: personas_naturales_rif_fkey

-- ALTER TABLE personas_naturales DROP CONSTRAINT personas_naturales_rif_fkey;

ALTER TABLE personas_naturales
  ADD CONSTRAINT personas_naturales_rif_fkey FOREIGN KEY (rif)
      REFERENCES sys_naturales_juridicas (rif) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION;











-- Table: actividades_economicas

-- DROP TABLE actividades_economicas;

CREATE TABLE actividades_economicas
(
  id serial NOT NULL, -- Clave primaria
  ppal_caev_id integer NOT NULL, -- Clave foranea sobre la actividad comercial principal
  comp1_caev_id integer NOT NULL, -- Codigo de la actividad economica complementaria 1
  comp2_caev_id integer NOT NULL, -- Codigo de la actividad economica complementaria 2
  contratista_id integer NOT NULL, -- Clave foranea a la tabla contratista
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone, -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT actividades_economicas_pkey PRIMARY KEY (id),
  CONSTRAINT actividades_economicas_comp1_caev_id_fkey FOREIGN KEY (comp1_caev_id)
      REFERENCES sys_caev (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT actividades_economicas_comp2_caev_id_fkey FOREIGN KEY (comp2_caev_id)
      REFERENCES sys_caev (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT actividades_economicas_contratista_id_fkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT actividades_economicas_ppal_caev_id_fkey FOREIGN KEY (ppal_caev_id)
      REFERENCES sys_caev (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE actividades_economicas
  OWNER TO eureka;
COMMENT ON TABLE actividades_economicas
  IS 'Tabla donde se almacenan todas las actividades economicas del contratista ';
COMMENT ON COLUMN actividades_economicas.id IS 'Clave primaria';
COMMENT ON COLUMN actividades_economicas.ppal_caev_id IS 'Clave foranea sobre la actividad comercial principal';
COMMENT ON COLUMN actividades_economicas.comp1_caev_id IS 'Codigo de la actividad economica complementaria 1';
COMMENT ON COLUMN actividades_economicas.comp2_caev_id IS 'Codigo de la actividad economica complementaria 2';
COMMENT ON COLUMN actividades_economicas.contratista_id IS 'Clave foranea a la tabla contratista';
COMMENT ON COLUMN actividades_economicas.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN actividades_economicas.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN actividades_economicas.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN actividades_economicas.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';




-- Table: contratistas_contactos

-- DROP TABLE contratistas_contactos;

CREATE TABLE contratistas_contactos
(
  id serial NOT NULL, -- Clave primaria
  contacto_id integer NOT NULL, -- CLave foranea a la tabla de personas_naturales
  contratista_id integer NOT NULL, -- CLave foranea a la tabla de contratistas
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone, -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT contratistas_contactos_pkey PRIMARY KEY (id),
  CONSTRAINT contratistas_contactos_contacto_id_fkey FOREIGN KEY (contacto_id)
      REFERENCES personas_naturales (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT contratistas_contactos_contratista_id_fkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE contratistas_contactos
  OWNER TO eureka;
COMMENT ON TABLE contratistas_contactos
  IS 'Tabla donde se almacenan todas las personnas de contacto de la contratista';
COMMENT ON COLUMN contratistas_contactos.id IS 'Clave primaria';
COMMENT ON COLUMN contratistas_contactos.contacto_id IS 'CLave foranea a la tabla de personas_naturales';
COMMENT ON COLUMN contratistas_contactos.contratista_id IS 'CLave foranea a la tabla de contratistas';
COMMENT ON COLUMN contratistas_contactos.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN contratistas_contactos.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN contratistas_contactos.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN contratistas_contactos.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';




-- Table: principios_contables

-- DROP TABLE principios_contables;

CREATE TABLE principios_contables
(
  id serial NOT NULL, -- Clave primaria
  principio_contable principio_contable NOT NULL, -- Enum con el nombre del principio contable
  codigo_sudeaseg character varying(255), -- Codigo sudeaseg en caso de ser una empresa de seguro
  contratista_id integer NOT NULL, -- Clave foranea a la tabla contratistas
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone, -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT principios_contables_pkey PRIMARY KEY (id),
  CONSTRAINT principios_contables_contratista_id_fkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE principios_contables
  OWNER TO eureka;
COMMENT ON TABLE principios_contables
  IS 'Tabla donde se almacena el principio contable de la contratista';
COMMENT ON COLUMN principios_contables.id IS 'Clave primaria';
COMMENT ON COLUMN principios_contables.principio_contable IS 'Enum con el nombre del principio contable';
COMMENT ON COLUMN principios_contables.codigo_sudeaseg IS 'Codigo sudeaseg en caso de ser una empresa de seguro';
COMMENT ON COLUMN principios_contables.contratista_id IS 'Clave foranea a la tabla contratistas';
COMMENT ON COLUMN principios_contables.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN principios_contables.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN principios_contables.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN principios_contables.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';



DROP TABLE empresas_relacionadas;

CREATE TABLE empresas_relacionadas
(
  id serial NOT NULL, -- Clave primaria
  tipo_relacion tipo_relacion_empresa NOT NULL, -- Tipo de relacion empresa puede ser accionista,inversion, cliente,  proveedor, convenio,filial / subsidiaria
  tipo_sector tipo_sector NOT NULL, -- Tipo sector puede ser Publico o Privado
  sys_pais_id integer, -- Clave foranea a la tabla sys_paises en caso de ser extranjero
  fecha_inicio date, -- Fecha de vigencia del inicio solo extranjeros
  fecha_fin date, -- Fecha vigencia fin solo extranjeros
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone, -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  persona_juridica_id integer NOT NULL, -- Clave foranea a la tabla personas juridicas
  persona_contacto_id integer NOT NULL, -- Clave foranea a personas_naturales
  CONSTRAINT empresas_relacionadas_pkey PRIMARY KEY (id),
  CONSTRAINT empresas_relacionadas_persona_contacto_id_fkey FOREIGN KEY (persona_contacto_id)
      REFERENCES personas_naturales (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT empresas_relacionadas_persona_juridica_id_fkey FOREIGN KEY (persona_juridica_id)
      REFERENCES personas_juridicas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE empresas_relacionadas
  OWNER TO eureka;
COMMENT ON TABLE empresas_relacionadas
  IS 'Tabla que almacena las empresas relacionadas con la contratista';
COMMENT ON COLUMN empresas_relacionadas.id IS 'Clave primaria';
COMMENT ON COLUMN empresas_relacionadas.tipo_relacion IS 'Tipo de relacion empresa puede ser accionista,inversion, cliente,  proveedor, convenio,filial / subsidiaria';
COMMENT ON COLUMN empresas_relacionadas.tipo_sector IS 'Tipo sector puede ser Publico o Privado';
COMMENT ON COLUMN empresas_relacionadas.sys_pais_id IS 'Clave foranea a la tabla sys_paises en caso de ser extranjero';
COMMENT ON COLUMN empresas_relacionadas.fecha_inicio IS 'Fecha de vigencia del inicio solo extranjeros';
COMMENT ON COLUMN empresas_relacionadas.fecha_fin IS 'Fecha vigencia fin solo extranjeros';
COMMENT ON COLUMN empresas_relacionadas.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN empresas_relacionadas.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN empresas_relacionadas.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN empresas_relacionadas.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';
COMMENT ON COLUMN empresas_relacionadas.persona_juridica_id IS 'Clave foranea a la tabla personas juridicas';
COMMENT ON COLUMN empresas_relacionadas.persona_contacto_id IS 'Clave foranea a personas_naturales';

ALTER TABLE personas_juridicas DROP COLUMN nacionalidad;


-- Column: tipo_nacionalidad

-- ALTER TABLE personas_juridicas DROP COLUMN tipo_nacionalidad;

ALTER TABLE personas_juridicas ADD COLUMN tipo_nacionalidad tipo_nacionalidad;
COMMENT ON COLUMN personas_juridicas.tipo_nacionalidad IS 'Enum tipo nacionalidad puede ser Nacional o extranjera';


-- Column: nacionalidad

ALTER TABLE personas_naturales DROP COLUMN nacionalidad;

ALTER TABLE personas_naturales ADD COLUMN nacionalidad tipo_nacionalidad;
ALTER TABLE personas_naturales ALTER COLUMN nacionalidad SET NOT NULL;
COMMENT ON COLUMN personas_naturales.nacionalidad IS 'Tipo de nacionalidad puede ser Venezolana o extranjera';

-- Column: numero_identificacion

-- ALTER TABLE personas_naturales DROP COLUMN numero_identificacion;

ALTER TABLE personas_naturales ADD COLUMN numero_identificacion character varying(255);
COMMENT ON COLUMN personas_naturales.numero_identificacion IS 'Numero de identificacion en caso de ser extranjero';

ALTER TABLE contratistas DROP COLUMN tipo_sector;

ALTER TABLE contratistas ADD COLUMN tipo_sector tipo_sector_mixto;
ALTER TABLE contratistas ALTER COLUMN tipo_sector SET NOT NULL;
COMMENT ON COLUMN contratistas.tipo_sector IS 'Tipo sector puede ser publico privado o mixto';

ALTER TABLE domicilios DROP COLUMN fiscal_id;
ALTER TABLE domicilios DROP COLUMN principal_id;

-- ALTER TABLE domicilios DROP COLUMN fiscal;

ALTER TABLE domicilios ADD COLUMN fiscal boolean;
ALTER TABLE domicilios ALTER COLUMN fiscal SET NOT NULL;
COMMENT ON COLUMN domicilios.fiscal IS 'Si es true es una direccion fiscal, si es false es una direccion principal';


-- ALTER TABLE domicilios DROP COLUMN direccion_id;

ALTER TABLE domicilios ADD COLUMN direccion_id integer;
ALTER TABLE domicilios ALTER COLUMN direccion_id SET NOT NULL;
COMMENT ON COLUMN domicilios.direccion_id IS 'Clave foranea a la tabla de direcciones';

ALTER TABLE domicilios DROP COLUMN documento_registrado_id;

ALTER TABLE domicilios ADD COLUMN documento_registrado_id integer;
COMMENT ON COLUMN domicilios.documento_registrado_id IS 'Clave foranea a la tabla documentos registrados  en el esquema activos';


ALTER TABLE sucursales DROP COLUMN id;
ALTER TABLE sucursales ADD COLUMN id integer;
ALTER TABLE sucursales ALTER COLUMN id SET NOT NULL;
ALTER TABLE sucursales ALTER COLUMN id SET DEFAULT nextval('sucursales_id_seq'::regclass);
COMMENT ON COLUMN sucursales.id IS 'clave primaria';
