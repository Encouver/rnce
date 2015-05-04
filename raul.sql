-- 04 mayo 2015

ALTER TABLE sucursales ADD COLUMN representante boolean;
ALTER TABLE sucursales ALTER COLUMN representante SET NOT NULL;
COMMENT ON COLUMN sucursales.representante IS 'Indica si la persona de contacto es o no representante legal';



ALTER TABLE sucursales ADD COLUMN accionista boolean;
ALTER TABLE sucursales ALTER COLUMN accionista SET NOT NULL;
COMMENT ON COLUMN sucursales.accionista IS 'Indica si el representante legal es un accionista';