CREATE TYPE tipo_moneda_enum AS ENUM ('Nacional', 'Extranjera');

ALTER TABLE nombres_cajas ADD COLUMN tipo_caja tipo_moneda_enum;
ALTER TABLE nombres_cajas ALTER COLUMN tipo_caja SET NOT NULL;
COMMENT ON COLUMN nombres_cajas.tipo_caja IS 'Valor que indica si la caja fue creada para moneda nacional o extranjera';