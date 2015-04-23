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
