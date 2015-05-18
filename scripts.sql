ALTER TABLE TABLA OWNER TO eureka;
TRUNCATE TABLE TABLA CASCADE;

-- Column: contratista_id

ALTER TABLE TABLA DROP COLUMN IF EXISTS contratista_id;

ALTER TABLE TABLA ADD COLUMN contratista_id integer;
ALTER TABLE TABLA ALTER COLUMN contratista_id SET NOT NULL;
COMMENT ON COLUMN TABLA.contratista_id IS 'Clave foranea al contratista';

ALTER TABLE TABLA
ADD FOREIGN KEY (contratista_id) REFERENCES contratistas (id) ON UPDATE CASCADE ON DELETE NO ACTION;

-- Column: anho

ALTER TABLE TABLA DROP COLUMN IF EXISTS anho;

ALTER TABLE TABLA ADD COLUMN anho character varying(100);
ALTER TABLE TABLA ALTER COLUMN anho SET NOT NULL;
COMMENT ON COLUMN TABLA.anho IS 'Año contable y mes';



-- Column: creado_por

ALTER TABLE TABLA DROP COLUMN IF EXISTS creado_por;

ALTER TABLE TABLA ADD COLUMN creado_por integer;
--ALTER TABLE TABLA ALTER COLUMN creado_por SET NOT NULL;
COMMENT ON COLUMN TABLA.creado_por IS 'Clave foranea al usuario';

-- Column: actualizado_por

ALTER TABLE TABLA DROP COLUMN IF EXISTS actualizado_por;

ALTER TABLE TABLA ADD COLUMN actualizado_por integer;
--ALTER TABLE TABLA ALTER COLUMN actualizado_por SET NOT NULL;
COMMENT ON COLUMN TABLA.actualizado_por IS 'Clave foranea al usuario';


-- Column: sys_status

ALTER TABLE TABLA DROP COLUMN IF EXISTS sys_status;

ALTER TABLE TABLA ADD COLUMN sys_status boolean;
ALTER TABLE TABLA ALTER COLUMN sys_status SET NOT NULL;
ALTER TABLE TABLA ALTER COLUMN sys_status SET DEFAULT true;
COMMENT ON COLUMN TABLA.sys_status IS 'Estatus interno del sistema';

ALTER TABLE TABLA DROP COLUMN IF EXISTS sys_fecha;

-- Column: sys_creado_el

 ALTER TABLE TABLA DROP COLUMN IF EXISTS sys_creado_el;

ALTER TABLE TABLA ADD COLUMN sys_creado_el timestamp with time zone;
ALTER TABLE TABLA ALTER COLUMN sys_creado_el SET DEFAULT now();
COMMENT ON COLUMN TABLA.sys_creado_el IS 'Fecha de creación del registro.';


-- Column: sys_actualizado_el

 ALTER TABLE TABLA DROP COLUMN IF EXISTS sys_actualizado_el;

ALTER TABLE TABLA ADD COLUMN sys_actualizado_el timestamp with time zone;
ALTER TABLE TABLA ALTER COLUMN sys_actualizado_el SET DEFAULT now();
COMMENT ON COLUMN TABLA.sys_actualizado_el IS 'Fecha de última actualización del registro.';


-- Column: sys_finalizado_el

 ALTER TABLE TABLA DROP COLUMN IF EXISTS sys_finalizado_el;

ALTER TABLE TABLA ADD COLUMN sys_finalizado_el timestamp with time zone;
COMMENT ON COLUMN TABLA.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';







DO
$$
DECLARE
  row record;
BEGIN
  FOR row IN SELECT tablename,schemaname FROM pg_tables WHERE schemaname = 'activos' or schemaname = 'cuentas' or schemaname = 'public' and not tablename like '%user%' and not tablename like '%auth%'-- and other conditions, if needed
  LOOP
    EXECUTE
    '
    ALTER TABLE '|| quote_ident(row.schemaname) || '.' || quote_ident(row.tablename) || ' OWNER TO eureka;
TRUNCATE TABLE '|| quote_ident(row.schemaname) || '.' || quote_ident(row.tablename) || ' CASCADE;

-- Column: creado_por

ALTER TABLE '|| quote_ident(row.schemaname) || '.' || quote_ident(row.tablename) || ' DROP COLUMN IF EXISTS creado_por;

ALTER TABLE '|| quote_ident(row.schemaname) || '.' || quote_ident(row.tablename) || ' ADD COLUMN creado_por integer;
--ALTER TABLE '|| quote_ident(row.schemaname) || '.' || quote_ident(row.tablename) || ' ALTER COLUMN creado_por SET NOT NULL;
COMMENT ON COLUMN '|| quote_ident(row.schemaname) || '.' || quote_ident(row.tablename) || '.creado_por IS ''Clave foranea al usuario'';

-- Column: actualizado_por

ALTER TABLE '|| quote_ident(row.schemaname) || '.' || quote_ident(row.tablename) || ' DROP COLUMN IF EXISTS actualizado_por;

ALTER TABLE '|| quote_ident(row.schemaname) || '.' || quote_ident(row.tablename) || ' ADD COLUMN actualizado_por integer;
--ALTER TABLE '|| quote_ident(row.schemaname) || '.' || quote_ident(row.tablename) || ' ALTER COLUMN actualizado_por SET NOT NULL;
COMMENT ON COLUMN '|| quote_ident(row.schemaname) || '.' || quote_ident(row.tablename) || '.actualizado_por IS ''Clave foranea al usuario'';


-- Column: sys_status

 ALTER TABLE '|| quote_ident(row.schemaname) || '.' || quote_ident(row.tablename) || ' DROP COLUMN IF EXISTS sys_status;

ALTER TABLE '|| quote_ident(row.schemaname) || '.' || quote_ident(row.tablename) || ' ADD COLUMN sys_status boolean;
ALTER TABLE '|| quote_ident(row.schemaname) || '.' || quote_ident(row.tablename) || ' ALTER COLUMN sys_status SET DEFAULT true;
ALTER TABLE '|| quote_ident(row.schemaname) || '.' || quote_ident(row.tablename) || ' ALTER COLUMN sys_status SET NOT NULL;
COMMENT ON COLUMN '|| quote_ident(row.schemaname) ||'.' || quote_ident(row.tablename) || '.sys_status IS ''Estatus interno del sistema'';


ALTER TABLE '|| quote_ident(row.schemaname) || '.' || quote_ident(row.tablename) || ' DROP COLUMN IF EXISTS sys_fecha;

-- Column: sys_creado_el

 ALTER TABLE '|| quote_ident(row.schemaname) || '.' || quote_ident(row.tablename) || ' DROP COLUMN IF EXISTS sys_creado_el;

ALTER TABLE '|| quote_ident(row.schemaname) || '.' || quote_ident(row.tablename) || ' ADD COLUMN sys_creado_el timestamp with time zone;
ALTER TABLE '|| quote_ident(row.schemaname) || '.' || quote_ident(row.tablename) || ' ALTER COLUMN sys_creado_el SET DEFAULT now();
COMMENT ON COLUMN '|| quote_ident(row.schemaname) || '.' || quote_ident(row.tablename) || '.sys_creado_el IS ''Fecha de creación del registro.'';


-- Column: sys_actualizado_el

 ALTER TABLE '|| quote_ident(row.schemaname) || '.' || quote_ident(row.tablename) || ' DROP COLUMN IF EXISTS sys_actualizado_el;

ALTER TABLE '|| quote_ident(row.schemaname) || '.' || quote_ident(row.tablename) || ' ADD COLUMN sys_actualizado_el timestamp with time zone;
ALTER TABLE '|| quote_ident(row.schemaname) || '.' || quote_ident(row.tablename) || ' ALTER COLUMN sys_actualizado_el SET DEFAULT now();
COMMENT ON COLUMN '|| quote_ident(row.schemaname) || '.' || quote_ident(row.tablename) || '.sys_actualizado_el IS ''Fecha de última actualización del registro.'';


-- Column: sys_finalizado_el

 ALTER TABLE '|| quote_ident(row.schemaname) || '.' || quote_ident(row.tablename) || ' DROP COLUMN IF EXISTS sys_finalizado_el;

ALTER TABLE '|| quote_ident(row.schemaname) || '.' || quote_ident(row.tablename) || ' ADD COLUMN sys_finalizado_el timestamp with time zone;
COMMENT ON COLUMN '|| quote_ident(row.schemaname) || '.' || quote_ident(row.tablename) || '.sys_finalizado_el IS ''Fecha de "eliminado" el registro.'';';
  END LOOP;
END;
$$;
