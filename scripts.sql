ALTER TABLE TABLA OWNER TO eureka;
TRUNCATE TABLE TABLA CASCADE;
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
--ALTER TABLE TABLA ALTER COLUMN sys_actualizado_el SET DEFAULT now();
COMMENT ON COLUMN TABLA.sys_actualizado_el IS 'Fecha de última actualización del registro.';


-- Column: sys_finalizado_el

 ALTER TABLE TABLA DROP COLUMN IF EXISTS sys_finalizado_el;

ALTER TABLE TABLA ADD COLUMN sys_finalizado_el timestamp with time zone;
--ALTER TABLE TABLA ALTER COLUMN sys_finalizado_el SET DEFAULT now();
COMMENT ON COLUMN TABLA.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';


DO
$$
DECLARE
    row record;
BEGIN
    FOR row IN SELECT tablename FROM pg_tables WHERE schemaname = 'activos' -- and other conditions, if needed
    LOOP
        EXECUTE 
'
ALTER TABLE activos.' || quote_ident(row.tablename) || ' OWNER TO eureka;
TRUNCATE TABLE ' || quote_ident(row.tablename) || ' CASCADE;
-- Column: sys_status

 ALTER TABLE activos.' || quote_ident(row.tablename) || ' DROP COLUMN IF EXISTS sys_status;

ALTER TABLE activos.' || quote_ident(row.tablename) || ' ADD COLUMN sys_status boolean;
ALTER TABLE activos.' || quote_ident(row.tablename) || ' ALTER COLUMN sys_status SET NOT NULL;
ALTER TABLE activos.' || quote_ident(row.tablename) || ' ALTER COLUMN sys_status SET DEFAULT true;
COMMENT ON COLUMN activos.' || quote_ident(row.tablename) || '.sys_status IS ''Estatus interno del sistema'';


ALTER TABLE activos.' || quote_ident(row.tablename) || ' DROP COLUMN IF EXISTS sys_fecha;

-- Column: sys_creado_el

 ALTER TABLE activos.' || quote_ident(row.tablename) || ' DROP COLUMN IF EXISTS sys_creado_el;

ALTER TABLE activos.' || quote_ident(row.tablename) || ' ADD COLUMN sys_creado_el timestamp with time zone;
ALTER TABLE activos.' || quote_ident(row.tablename) || ' ALTER COLUMN sys_creado_el SET DEFAULT now();
COMMENT ON COLUMN activos.' || quote_ident(row.tablename) || '.sys_creado_el IS ''Fecha de creación del registro.'';


-- Column: sys_actualizado_el

 ALTER TABLE activos.' || quote_ident(row.tablename) || ' DROP COLUMN IF EXISTS sys_actualizado_el;

ALTER TABLE activos.' || quote_ident(row.tablename) || ' ADD COLUMN sys_actualizado_el timestamp with time zone;
--ALTER TABLE activos.' || quote_ident(row.tablename) || ' ALTER COLUMN sys_actualizado_el SET DEFAULT now();
COMMENT ON COLUMN activos.' || quote_ident(row.tablename) || '.sys_actualizado_el IS ''Fecha de última actualización del registro.'';


-- Column: sys_finalizado_el

 ALTER TABLE activos.' || quote_ident(row.tablename) || ' DROP COLUMN IF EXISTS sys_finalizado_el;

ALTER TABLE activos.' || quote_ident(row.tablename) || ' ADD COLUMN sys_finalizado_el timestamp with time zone;
--ALTER TABLE activos.' || quote_ident(row.tablename) || ' ALTER COLUMN sys_finalizado_el SET DEFAULT now();
COMMENT ON COLUMN activos.' || quote_ident(row.tablename) || '.sys_finalizado_el IS ''Fecha de "eliminado" el registro.'';';
    END LOOP;
END;
$$;
