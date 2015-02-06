--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- Name: enum_caja; Type: TYPE; Schema: public; Owner: eureka
--

CREATE TYPE enum_caja AS ENUM (
    'caja',
    'caja chica'
);


ALTER TYPE public.enum_caja OWNER TO eureka;

--
-- Name: enum_concepto; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE enum_concepto AS ENUM (
    'venta',
    'servicio',
    'obra'
);


ALTER TYPE public.enum_concepto OWNER TO postgres;

--
-- Name: enum_gastos; Type: TYPE; Schema: public; Owner: eureka
--

CREATE TYPE enum_gastos AS ENUM (
    'Intereses',
    'Arrendamiento de bienes inmuebles',
    'Arrendamiento de bienes muebles',
    'Pólizas de seguro',
    'Fianza Fiel cumplimiento',
    'Fianza garantía laboral',
    'Otros pagos anticipado (Especificar)',
    'Existencia artículos de oficina',
    'Existencia artículos de limpieza',
    'Otras existencias (Especificar)'
);


ALTER TYPE public.enum_gastos OWNER TO eureka;

--
-- Name: enum_inventario; Type: TYPE; Schema: public; Owner: eureka
--

CREATE TYPE enum_inventario AS ENUM (
    'Materias primas',
    'Productos en proceso',
    'Productos terminados',
    'Materiales y suministros',
    'Repuestos, accesorios y herramientas',
    'Material de empaque y embalaje',
    'Mercancías',
    'Servicios en proceso',
    'Otros inventarios'
);


ALTER TYPE public.enum_inventario OWNER TO eureka;

--
-- Name: enum_islr; Type: TYPE; Schema: public; Owner: eureka
--

CREATE TYPE enum_islr AS ENUM (
    'Declaración estimada',
    'Retenido por clientes',
    'Otros créditos fiscales'
);


ALTER TYPE public.enum_islr OWNER TO eureka;

--
-- Name: enum_iva_otros; Type: TYPE; Schema: public; Owner: eureka
--

CREATE TYPE enum_iva_otros AS ENUM (
    'Excedente de crédito fiscal',
    'Retenido por clientes',
    'Otros créditos fiscales',
    'Otros tributos pagados por anticipado'
);


ALTER TYPE public.enum_iva_otros OWNER TO eureka;

--
-- Name: enum_meses; Type: TYPE; Schema: public; Owner: eureka
--

CREATE TYPE enum_meses AS ENUM (
    'Enero',
    'Febrero',
    'Marzo',
    'Abril',
    'Mayo',
    'Junio',
    'Julio',
    'Agosto',
    'Septiembre',
    'Octubre',
    'Noviembre',
    'Diciembre'
);


ALTER TYPE public.enum_meses OWNER TO eureka;

--
-- Name: enum_otros_activos; Type: TYPE; Schema: public; Owner: eureka
--

CREATE TYPE enum_otros_activos AS ENUM (
    'Corrientes',
    'No Corrientes'
);


ALTER TYPE public.enum_otros_activos OWNER TO eureka;

--
-- Name: enum_sector; Type: TYPE; Schema: public; Owner: eureka
--

CREATE TYPE enum_sector AS ENUM (
    'Privado',
    'Publico'
);


ALTER TYPE public.enum_sector OWNER TO eureka;

--
-- Name: enum_tipo_propiedad; Type: TYPE; Schema: public; Owner: eureka
--

CREATE TYPE enum_tipo_propiedad AS ENUM (
    'Terreno',
    'Edificio'
);


ALTER TYPE public.enum_tipo_propiedad OWNER TO eureka;

--
-- Name: tipo_cuentas; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE tipo_cuentas AS ENUM (
    'pub',
    'pri'
);


ALTER TYPE public.tipo_cuentas OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: bancos; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE bancos (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    rif character varying(100) NOT NULL,
    codigo_sudeban character varying(5) NOT NULL
);


ALTER TABLE public.bancos OWNER TO eureka;

--
-- Name: COLUMN bancos.id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN bancos.id IS 'Clave primaria';


--
-- Name: COLUMN bancos.nombre; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN bancos.nombre IS 'Nombre del banco';


--
-- Name: COLUMN bancos.rif; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN bancos.rif IS 'Rif del banco';


--
-- Name: COLUMN bancos.codigo_sudeban; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN bancos.codigo_sudeban IS 'Codigo de sudeban asociado al banco.';


--
-- Name: Bancos_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE "Bancos_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."Bancos_id_seq" OWNER TO eureka;

--
-- Name: Bancos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE "Bancos_id_seq" OWNED BY bancos.id;


--
-- Name: accionistas; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE accionistas (
    id integer NOT NULL,
    persona_natural_id integer NOT NULL,
    contratista_id integer NOT NULL
);


ALTER TABLE public.accionistas OWNER TO eureka;

--
-- Name: TABLE accionistas; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON TABLE accionistas IS 'Accionistas de la contratista';


--
-- Name: COLUMN accionistas.id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN accionistas.id IS 'Clave primaria';


--
-- Name: COLUMN accionistas.persona_natural_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN accionistas.persona_natural_id IS 'Clave foranea a "id" en la tabla persona_natural';


--
-- Name: COLUMN accionistas.contratista_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN accionistas.contratista_id IS 'Clave foranea a "id" en la tabla contratistas';


--
-- Name: accionistas_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE accionistas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.accionistas_id_seq OWNER TO eureka;

--
-- Name: accionistas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE accionistas_id_seq OWNED BY accionistas.id;


--
-- Name: bancos_contratistas; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE bancos_contratistas (
    id integer NOT NULL,
    banco_id integer NOT NULL,
    contratista_id integer NOT NULL,
    num_cuenta character varying(150),
    ano date,
    activo boolean DEFAULT true
);


ALTER TABLE public.bancos_contratistas OWNER TO eureka;

--
-- Name: COLUMN bancos_contratistas.id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN bancos_contratistas.id IS 'Clave primaria';


--
-- Name: COLUMN bancos_contratistas.banco_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN bancos_contratistas.banco_id IS 'Clave foranea a la tabla Banco';


--
-- Name: COLUMN bancos_contratistas.contratista_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN bancos_contratistas.contratista_id IS 'Clave foranea a la tabla Contratista';


--
-- Name: COLUMN bancos_contratistas.num_cuenta; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN bancos_contratistas.num_cuenta IS 'Número de cuenta bancaria';


--
-- Name: COLUMN bancos_contratistas.ano; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN bancos_contratistas.ano IS 'Año cargado';


--
-- Name: COLUMN bancos_contratistas.activo; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN bancos_contratistas.activo IS 'Si el registro se encuentra habilitado o no.';


--
-- Name: bancos_contratistas_contratista_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE bancos_contratistas_contratista_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.bancos_contratistas_contratista_id_seq OWNER TO eureka;

--
-- Name: bancos_contratistas_contratista_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE bancos_contratistas_contratista_id_seq OWNED BY bancos_contratistas.contratista_id;


--
-- Name: bancos_contratistas_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE bancos_contratistas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.bancos_contratistas_id_seq OWNER TO eureka;

--
-- Name: bancos_contratistas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE bancos_contratistas_id_seq OWNED BY bancos_contratistas.id;


--
-- Name: clientes; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE clientes (
    id integer NOT NULL,
    nombre character varying(255),
    rif character varying(10) NOT NULL,
    publico boolean NOT NULL,
    contratista_id integer NOT NULL
);


ALTER TABLE public.clientes OWNER TO eureka;

--
-- Name: COLUMN clientes.rif; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN clientes.rif IS 'RIF del cliente';


--
-- Name: COLUMN clientes.publico; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN clientes.publico IS 'Sector público o privado';


--
-- Name: COLUMN clientes.contratista_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN clientes.contratista_id IS 'FK_contratista:id para indicar a que contratista pertence el cliente';


--
-- Name: clientes_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE clientes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.clientes_id_seq OWNER TO eureka;

--
-- Name: clientes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE clientes_id_seq OWNED BY clientes.id;


--
-- Name: contratistas; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE contratistas (
    id integer NOT NULL,
    empresa_id integer NOT NULL
);


ALTER TABLE public.contratistas OWNER TO eureka;

--
-- Name: COLUMN contratistas.id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN contratistas.id IS 'Clave primaria';


--
-- Name: COLUMN contratistas.empresa_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN contratistas.empresa_id IS 'Empresa la cual es una contratista';


--
-- Name: contratistas_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE contratistas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.contratistas_id_seq OWNER TO eureka;

--
-- Name: contratistas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE contratistas_id_seq OWNED BY contratistas.id;


--
-- Name: cuentas; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE cuentas (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL
);


ALTER TABLE public.cuentas OWNER TO eureka;

--
-- Name: TABLE cuentas; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON TABLE cuentas IS 'Tabla que relaciona una cuenta con un identificador unico';


--
-- Name: COLUMN cuentas.id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN cuentas.id IS 'Clave primaria';


--
-- Name: COLUMN cuentas.nombre; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN cuentas.nombre IS 'Nombre de la cuenta';


--
-- Name: cuentas_cobrar_sprivpub; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE cuentas_cobrar_sprivpub (
    id integer NOT NULL,
    venta boolean,
    servicio boolean,
    obras boolean,
    num_contrato_factura character varying(255) NOT NULL,
    monto_contrato_f numeric(38,6) NOT NULL,
    procentaje_a integer,
    plazo_contrato integer,
    contatista_id integer NOT NULL,
    ano date DEFAULT now(),
    tipo_cuenta tipo_cuentas
);


ALTER TABLE public.cuentas_cobrar_sprivpub OWNER TO eureka;

--
-- Name: TABLE cuentas_cobrar_sprivpub; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON TABLE cuentas_cobrar_sprivpub IS 'Tabla perteneciente a la cuenta B-1';


--
-- Name: COLUMN cuentas_cobrar_sprivpub.id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN cuentas_cobrar_sprivpub.id IS 'Clave primaria';


--
-- Name: COLUMN cuentas_cobrar_sprivpub.venta; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN cuentas_cobrar_sprivpub.venta IS 'Tipo de concepto venta';


--
-- Name: COLUMN cuentas_cobrar_sprivpub.servicio; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN cuentas_cobrar_sprivpub.servicio IS 'Tipo de concepto servicio';


--
-- Name: COLUMN cuentas_cobrar_sprivpub.obras; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN cuentas_cobrar_sprivpub.obras IS 'Tipo de concepto obras';


--
-- Name: COLUMN cuentas_cobrar_sprivpub.monto_contrato_f; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN cuentas_cobrar_sprivpub.monto_contrato_f IS 'Monto del contrato o de la factura.';


--
-- Name: COLUMN cuentas_cobrar_sprivpub.procentaje_a; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN cuentas_cobrar_sprivpub.procentaje_a IS 'Porcentaje de avance del Concepto';


--
-- Name: COLUMN cuentas_cobrar_sprivpub.plazo_contrato; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN cuentas_cobrar_sprivpub.plazo_contrato IS 'Plazo del contrato relacionado con el concepto, expresado en meses.';


--
-- Name: COLUMN cuentas_cobrar_sprivpub.contatista_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN cuentas_cobrar_sprivpub.contatista_id IS 'FK para id, lograr mantener a que contratista le pertence la cuenta por cobrar del sector publico';


--
-- Name: COLUMN cuentas_cobrar_sprivpub.tipo_cuenta; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN cuentas_cobrar_sprivpub.tipo_cuenta IS 'Si la entrada representa una cuenta por cobrar para el sector publico o privado';


--
-- Name: cuentas_cobrar_spri_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE cuentas_cobrar_spri_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cuentas_cobrar_spri_id_seq OWNER TO eureka;

--
-- Name: cuentas_cobrar_spri_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE cuentas_cobrar_spri_id_seq OWNED BY cuentas_cobrar_sprivpub.id;


--
-- Name: cuentas_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE cuentas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cuentas_id_seq OWNER TO eureka;

--
-- Name: cuentas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE cuentas_id_seq OWNED BY cuentas.id;


--
-- Name: otras_cuentas_cobrar; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE otras_cuentas_cobrar (
    id integer NOT NULL,
    tipo_deudor_id integer,
    nombre character varying(255) NOT NULL,
    origen character varying(255) NOT NULL,
    fecha time without time zone NOT NULL,
    garantia character varying(255) NOT NULL,
    plazo character varying(255) NOT NULL,
    ano date NOT NULL,
    contratista_id integer NOT NULL,
    activo boolean DEFAULT true
);


ALTER TABLE public.otras_cuentas_cobrar OWNER TO eureka;

--
-- Name: COLUMN otras_cuentas_cobrar.id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN otras_cuentas_cobrar.id IS 'Clave primaria';


--
-- Name: COLUMN otras_cuentas_cobrar.tipo_deudor_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN otras_cuentas_cobrar.tipo_deudor_id IS 'FK:id para verificar que tipo de deudor es';


--
-- Name: COLUMN otras_cuentas_cobrar.contratista_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN otras_cuentas_cobrar.contratista_id IS 'Clave foránea a la tabla Contratistas';


--
-- Name: COLUMN otras_cuentas_cobrar.activo; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN otras_cuentas_cobrar.activo IS 'Si el registro esta habilitado o no';


--
-- Name: cuentas_por_cobrar_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE cuentas_por_cobrar_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cuentas_por_cobrar_id_seq OWNER TO eureka;

--
-- Name: cuentas_por_cobrar_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE cuentas_por_cobrar_id_seq OWNED BY otras_cuentas_cobrar.id;


--
-- Name: directores; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE directores (
    id integer NOT NULL,
    persona_natural_id integer NOT NULL,
    contratista_id integer NOT NULL,
    miembro_junta boolean DEFAULT false NOT NULL
);


ALTER TABLE public.directores OWNER TO eureka;

--
-- Name: TABLE directores; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON TABLE directores IS 'Directores Administradores de una contratista';


--
-- Name: COLUMN directores.id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN directores.id IS 'Clave primaria';


--
-- Name: COLUMN directores.persona_natural_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN directores.persona_natural_id IS 'Persona natural';


--
-- Name: COLUMN directores.contratista_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN directores.contratista_id IS 'Contratista';


--
-- Name: COLUMN directores.miembro_junta; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN directores.miembro_junta IS 'Miembro de junta directiva';


--
-- Name: directores_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE directores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.directores_id_seq OWNER TO eureka;

--
-- Name: directores_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE directores_id_seq OWNED BY directores.id;


--
-- Name: efectivo_banco; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE efectivo_banco (
    id integer NOT NULL,
    contratista_id integer NOT NULL,
    banco_id integer NOT NULL,
    saldo_banco numeric(38,6) NOT NULL,
    depos_transito numeric(38,6) NOT NULL,
    che_transito numeric(38,6) NOT NULL,
    nd_contabilizadas numeric(38,6) NOT NULL,
    nc_contabilizadas numeric(38,6) NOT NULL,
    ano date NOT NULL,
    activo boolean DEFAULT true
);


ALTER TABLE public.efectivo_banco OWNER TO eureka;

--
-- Name: COLUMN efectivo_banco.id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN efectivo_banco.id IS 'Clave primaria';


--
-- Name: COLUMN efectivo_banco.contratista_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN efectivo_banco.contratista_id IS 'Clave foranea a la tabla Contratistas';


--
-- Name: COLUMN efectivo_banco.banco_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN efectivo_banco.banco_id IS 'Clave primaria a la tabla Banco';


--
-- Name: COLUMN efectivo_banco.saldo_banco; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN efectivo_banco.saldo_banco IS 'Saldo según bancos';


--
-- Name: COLUMN efectivo_banco.depos_transito; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN efectivo_banco.depos_transito IS 'Depositos en transito';


--
-- Name: COLUMN efectivo_banco.che_transito; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN efectivo_banco.che_transito IS 'Cheques en tránsito';


--
-- Name: COLUMN efectivo_banco.nd_contabilizadas; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN efectivo_banco.nd_contabilizadas IS 'ND no contabilizadas errores/DB';


--
-- Name: COLUMN efectivo_banco.nc_contabilizadas; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN efectivo_banco.nc_contabilizadas IS 'NC no contabilizadas errores/Cr';


--
-- Name: COLUMN efectivo_banco.activo; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN efectivo_banco.activo IS 'Si el registro esta habilitado o no';


--
-- Name: efectivo_banco_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE efectivo_banco_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.efectivo_banco_id_seq OWNER TO eureka;

--
-- Name: efectivo_banco_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE efectivo_banco_id_seq OWNED BY efectivo_banco.id;


--
-- Name: efectivo_caja; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE efectivo_caja (
    id integer NOT NULL,
    contratista_id integer NOT NULL,
    ano date NOT NULL,
    tipo enum_caja NOT NULL,
    tipo_caja_id integer NOT NULL,
    activo boolean DEFAULT true
);


ALTER TABLE public.efectivo_caja OWNER TO eureka;

--
-- Name: COLUMN efectivo_caja.id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN efectivo_caja.id IS 'Clave primaria';


--
-- Name: COLUMN efectivo_caja.contratista_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN efectivo_caja.contratista_id IS 'Clave foranea a la tabla Contratistas';


--
-- Name: COLUMN efectivo_caja.tipo; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN efectivo_caja.tipo IS 'Caja/Caja chica';


--
-- Name: COLUMN efectivo_caja.tipo_caja_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN efectivo_caja.tipo_caja_id IS 'Clave foranea a la tabla tipo_caja';


--
-- Name: COLUMN efectivo_caja.activo; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN efectivo_caja.activo IS 'Si el registro esta habilitado o no';


--
-- Name: efectivo_caja_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE efectivo_caja_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.efectivo_caja_id_seq OWNER TO eureka;

--
-- Name: efectivo_caja_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE efectivo_caja_id_seq OWNED BY efectivo_caja.id;


--
-- Name: personas_juridicas; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE personas_juridicas (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    rif character varying(255) NOT NULL
);


ALTER TABLE public.personas_juridicas OWNER TO eureka;

--
-- Name: TABLE personas_juridicas; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON TABLE personas_juridicas IS 'Personas Juridicas';


--
-- Name: empresas_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE empresas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.empresas_id_seq OWNER TO eureka;

--
-- Name: empresas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE empresas_id_seq OWNED BY personas_juridicas.id;


--
-- Name: empresas_relacionadas; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE empresas_relacionadas (
    id integer NOT NULL,
    empresa_id integer NOT NULL,
    contratista_id integer NOT NULL,
    otras_cuentas_pagar_id integer NOT NULL,
    participacion numeric(38,6)
);


ALTER TABLE public.empresas_relacionadas OWNER TO eureka;

--
-- Name: COLUMN empresas_relacionadas.id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN empresas_relacionadas.id IS 'Clave primaria';


--
-- Name: COLUMN empresas_relacionadas.empresa_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN empresas_relacionadas.empresa_id IS 'Empresa relacionada';


--
-- Name: COLUMN empresas_relacionadas.contratista_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN empresas_relacionadas.contratista_id IS 'Empresa contratista';


--
-- Name: COLUMN empresas_relacionadas.otras_cuentas_pagar_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN empresas_relacionadas.otras_cuentas_pagar_id IS 'Clave foránea a la tabla otras_cuentas_pagar';


--
-- Name: COLUMN empresas_relacionadas.participacion; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN empresas_relacionadas.participacion IS 'Porcentaje de acciones o participacion que tiene la empresa con la contratista.';


--
-- Name: empresas_relacionadas_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE empresas_relacionadas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.empresas_relacionadas_id_seq OWNER TO eureka;

--
-- Name: empresas_relacionadas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE empresas_relacionadas_id_seq OWNED BY empresas_relacionadas.id;


--
-- Name: gastos_pag_ant; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE gastos_pag_ant (
    id integer NOT NULL,
    gastos enum_gastos NOT NULL,
    ref_proveedor_ppal character varying(255) NOT NULL,
    saldo_per_ant numeric(38,6) NOT NULL,
    importe_contratado_per numeric(38,6) NOT NULL,
    reintegro_apli_amorti numeric(38,6) NOT NULL,
    saldo_contabilidad numeric(38,6) NOT NULL,
    ano date NOT NULL
);


ALTER TABLE public.gastos_pag_ant OWNER TO eureka;

--
-- Name: COLUMN gastos_pag_ant.id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN gastos_pag_ant.id IS 'Clave primaria';


--
-- Name: COLUMN gastos_pag_ant.gastos; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN gastos_pag_ant.gastos IS 'Gastos pagados por anticipado';


--
-- Name: COLUMN gastos_pag_ant.ref_proveedor_ppal; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN gastos_pag_ant.ref_proveedor_ppal IS 'Referencia Proveedor Principal';


--
-- Name: COLUMN gastos_pag_ant.saldo_per_ant; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN gastos_pag_ant.saldo_per_ant IS 'Saldo del Período Anterior';


--
-- Name: COLUMN gastos_pag_ant.importe_contratado_per; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN gastos_pag_ant.importe_contratado_per IS 'Importe Contratado en el período';


--
-- Name: COLUMN gastos_pag_ant.reintegro_apli_amorti; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN gastos_pag_ant.reintegro_apli_amorti IS 'Reintegro Aplicación o Amortización';


--
-- Name: COLUMN gastos_pag_ant.saldo_contabilidad; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN gastos_pag_ant.saldo_contabilidad IS 'Saldo según Contabilidad';


--
-- Name: gastos_pag_ant_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE gastos_pag_ant_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.gastos_pag_ant_id_seq OWNER TO eureka;

--
-- Name: gastos_pag_ant_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE gastos_pag_ant_id_seq OWNED BY gastos_pag_ant.id;


--
-- Name: inpc; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE inpc (
    id integer NOT NULL,
    mes integer NOT NULL,
    indice numeric(38,6) NOT NULL,
    ano integer NOT NULL
);


ALTER TABLE public.inpc OWNER TO eureka;

--
-- Name: TABLE inpc; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON TABLE inpc IS 'Tabla que contiene el indice nacional de precio y consumidor emitida por el BCV';


--
-- Name: COLUMN inpc.id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN inpc.id IS 'Clave primaria';


--
-- Name: COLUMN inpc.mes; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN inpc.mes IS 'Mes de 1 a 12';


--
-- Name: COLUMN inpc.indice; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN inpc.indice IS 'Indice de inflación por mes';


--
-- Name: inpc_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE inpc_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.inpc_id_seq OWNER TO eureka;

--
-- Name: inpc_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE inpc_id_seq OWNED BY inpc.id;


--
-- Name: inventarios; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE inventarios (
    id integer NOT NULL,
    tec_med_costo character varying(255) NOT NULL,
    for_cal_costo character varying(255) NOT NULL,
    costo_adquisicion numeric(38,6) NOT NULL,
    ajuste_inflacion character varying(255) NOT NULL,
    reverso_deterioro character varying(255) NOT NULL,
    saldo_contabilidad numeric(38,6) NOT NULL,
    inventario enum_inventario NOT NULL
);


ALTER TABLE public.inventarios OWNER TO eureka;

--
-- Name: COLUMN inventarios.tec_med_costo; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN inventarios.tec_med_costo IS 'Técnica de Medición del Costo';


--
-- Name: COLUMN inventarios.for_cal_costo; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN inventarios.for_cal_costo IS 'Fórmula de cálculo del Costo';


--
-- Name: COLUMN inventarios.costo_adquisicion; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN inventarios.costo_adquisicion IS 'Costo de adqusición o producción';


--
-- Name: COLUMN inventarios.ajuste_inflacion; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN inventarios.ajuste_inflacion IS 'Ajuste por inflacion';


--
-- Name: COLUMN inventarios.reverso_deterioro; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN inventarios.reverso_deterioro IS 'Reverso del deterioro (Deterioro)';


--
-- Name: COLUMN inventarios.saldo_contabilidad; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN inventarios.saldo_contabilidad IS 'Saldo según Contabilidad';


--
-- Name: COLUMN inventarios.inventario; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN inventarios.inventario IS 'Inventario';


--
-- Name: inventario_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE inventario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.inventario_id_seq OWNER TO eureka;

--
-- Name: inventario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE inventario_id_seq OWNED BY inventarios.id;


--
-- Name: inventarios_c; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE inventarios_c (
    id integer NOT NULL,
    tecnica_medicion character varying(255) NOT NULL,
    formula_calculo character varying(255) NOT NULL,
    costo_adquisicion numeric(38,6) NOT NULL,
    ajuste_inflacion numeric(38,6) NOT NULL,
    reservo_deterioro numeric(38,6),
    contratista_id integer NOT NULL,
    ano date DEFAULT now()
);


ALTER TABLE public.inventarios_c OWNER TO eureka;

--
-- Name: TABLE inventarios_c; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON TABLE inventarios_c IS 'Tabla que mantiene las entradas de los inventarios segun su cada contratista';


--
-- Name: COLUMN inventarios_c.id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN inventarios_c.id IS 'Clave primaria';


--
-- Name: COLUMN inventarios_c.tecnica_medicion; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN inventarios_c.tecnica_medicion IS 'Técnica de medicion del costo';


--
-- Name: COLUMN inventarios_c.formula_calculo; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN inventarios_c.formula_calculo IS 'Fórmula de cálculo del costo';


--
-- Name: COLUMN inventarios_c.costo_adquisicion; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN inventarios_c.costo_adquisicion IS 'Costo de adquisición o producción';


--
-- Name: COLUMN inventarios_c.ajuste_inflacion; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN inventarios_c.ajuste_inflacion IS 'Ajuste por inflación';


--
-- Name: COLUMN inventarios_c.reservo_deterioro; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN inventarios_c.reservo_deterioro IS 'Deterioro';


--
-- Name: COLUMN inventarios_c.contratista_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN inventarios_c.contratista_id IS 'FK campo id, para mantener relacion de quien es la entrada en el inventario, es decir aque contratista pertence.';


--
-- Name: inventarios_c_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE inventarios_c_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.inventarios_c_id_seq OWNER TO eureka;

--
-- Name: inventarios_c_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE inventarios_c_id_seq OWNED BY inventarios_c.id;


--
-- Name: inversiones; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE inversiones (
    id integer NOT NULL,
    banco_id integer NOT NULL,
    costo_adquisicion numeric(38,6) NOT NULL,
    valor_desvalorizacion numeric(38,6) NOT NULL,
    contratista_id integer NOT NULL,
    ano date NOT NULL,
    activo boolean DEFAULT true,
    plazo integer NOT NULL,
    tasa_interes numeric(38,6) NOT NULL,
    tipo_inversion integer NOT NULL
);


ALTER TABLE public.inversiones OWNER TO eureka;

--
-- Name: COLUMN inversiones.banco_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN inversiones.banco_id IS 'Clave foranea a la tabla Bancos';


--
-- Name: COLUMN inversiones.valor_desvalorizacion; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN inversiones.valor_desvalorizacion IS 'Valorización desvalorización';


--
-- Name: COLUMN inversiones.contratista_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN inversiones.contratista_id IS 'Clave foranea a la tabla Contratistas';


--
-- Name: COLUMN inversiones.activo; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN inversiones.activo IS 'Si el registro esta habilitado o no';


--
-- Name: COLUMN inversiones.plazo; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN inversiones.plazo IS 'Plazo de la inversion representados del 1 al 12 (POR MES)';


--
-- Name: COLUMN inversiones.tipo_inversion; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN inversiones.tipo_inversion IS 'FK_tipo_inversion:id para enlazar el tipo de inversion que exista con el contratista';


--
-- Name: inversiones_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE inversiones_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.inversiones_id_seq OWNER TO eureka;

--
-- Name: inversiones_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE inversiones_id_seq OWNED BY inversiones.id;


--
-- Name: migration; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE migration (
    version character varying(180) NOT NULL,
    apply_time integer
);


ALTER TABLE public.migration OWNER TO eureka;

--
-- Name: notas_revelatorias; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE notas_revelatorias (
    id integer NOT NULL,
    nota text NOT NULL,
    usuario_id integer NOT NULL,
    contratista_id integer NOT NULL,
    ano date DEFAULT now(),
    cuenta integer NOT NULL
);


ALTER TABLE public.notas_revelatorias OWNER TO eureka;

--
-- Name: COLUMN notas_revelatorias.id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN notas_revelatorias.id IS 'Clave Primaria';


--
-- Name: COLUMN notas_revelatorias.nota; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN notas_revelatorias.nota IS 'Descripcion de la nota revelataroia';


--
-- Name: COLUMN notas_revelatorias.usuario_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN notas_revelatorias.usuario_id IS 'Clave foranea a la tabla Usuarios.';


--
-- Name: COLUMN notas_revelatorias.contratista_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN notas_revelatorias.contratista_id IS 'Clave foranea a la tabla Contratistas';


--
-- Name: COLUMN notas_revelatorias.cuenta; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN notas_revelatorias.cuenta IS 'Numero asociado a la cuenta a la cual se va a asociar la nota revelatoria';


--
-- Name: notas_revelatorias_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE notas_revelatorias_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.notas_revelatorias_id_seq OWNER TO eureka;

--
-- Name: notas_revelatorias_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE notas_revelatorias_id_seq OWNED BY notas_revelatorias.id;


--
-- Name: personas_naturales; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE personas_naturales (
    id integer NOT NULL,
    nombre character varying(150) NOT NULL,
    cedula character varying(50) NOT NULL
);


ALTER TABLE public.personas_naturales OWNER TO eureka;

--
-- Name: TABLE personas_naturales; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON TABLE personas_naturales IS 'Toda persona natural que pueda estar registrada en una contratista, ya sea como accionista, empleado, etc.';


--
-- Name: COLUMN personas_naturales.id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN personas_naturales.id IS 'Clave primaria';


--
-- Name: COLUMN personas_naturales.nombre; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN personas_naturales.nombre IS 'Nombre de la persona';


--
-- Name: COLUMN personas_naturales.cedula; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN personas_naturales.cedula IS 'Cédula de identidad de la persona';


--
-- Name: personas_naturales_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE personas_naturales_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.personas_naturales_id_seq OWNER TO eureka;

--
-- Name: personas_naturales_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE personas_naturales_id_seq OWNED BY personas_naturales.id;


--
-- Name: reps_legales; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE reps_legales (
    id integer NOT NULL,
    persona_natural_id integer,
    contratista_id integer NOT NULL
);


ALTER TABLE public.reps_legales OWNER TO eureka;

--
-- Name: TABLE reps_legales; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON TABLE reps_legales IS 'Tabla donde se almacenan los representantes legales de l contratista';


--
-- Name: COLUMN reps_legales.id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN reps_legales.id IS 'Clave primaria';


--
-- Name: COLUMN reps_legales.persona_natural_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN reps_legales.persona_natural_id IS 'FK de la persona natural que es representante legal';


--
-- Name: COLUMN reps_legales.contratista_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN reps_legales.contratista_id IS 'FK de la contratista a la cual pertenece el representante legal';


--
-- Name: reps_legales_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE reps_legales_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.reps_legales_id_seq OWNER TO eureka;

--
-- Name: reps_legales_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE reps_legales_id_seq OWNED BY reps_legales.id;


--
-- Name: sustento_conts; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE sustento_conts (
    id integer NOT NULL,
    descripcion character varying(255) NOT NULL,
    tipo_sustento_id integer NOT NULL,
    contratista_id integer NOT NULL,
    ano date DEFAULT now()
);


ALTER TABLE public.sustento_conts OWNER TO eureka;

--
-- Name: TABLE sustento_conts; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON TABLE sustento_conts IS 'Tabla que contiene la relacion de la cuenta a la que aplica el sustento por contratista';


--
-- Name: COLUMN sustento_conts.id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN sustento_conts.id IS 'Clave primaria';


--
-- Name: COLUMN sustento_conts.descripcion; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN sustento_conts.descripcion IS 'Descripcion que requiera necesaria por el contratista para explicar el dato clave del sustento';


--
-- Name: COLUMN sustento_conts.tipo_sustento_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN sustento_conts.tipo_sustento_id IS 'FK_tipos_sustentos:id';


--
-- Name: COLUMN sustento_conts.contratista_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN sustento_conts.contratista_id IS 'FK_contratista:id para mantener el historico de los sustentos marcados por el contratista';


--
-- Name: sustento_cont_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE sustento_cont_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sustento_cont_id_seq OWNER TO eureka;

--
-- Name: sustento_cont_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE sustento_cont_id_seq OWNED BY sustento_conts.id;


--
-- Name: tipos_cajas; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE tipos_cajas (
    id integer NOT NULL,
    nombre character varying(255),
    contratista_id integer NOT NULL,
    ano date,
    activo boolean DEFAULT true NOT NULL
);


ALTER TABLE public.tipos_cajas OWNER TO eureka;

--
-- Name: TABLE tipos_cajas; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON TABLE tipos_cajas IS 'Tipo de caja (chica o grande)';


--
-- Name: COLUMN tipos_cajas.id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN tipos_cajas.id IS 'Clave primaria';


--
-- Name: COLUMN tipos_cajas.nombre; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN tipos_cajas.nombre IS 'Nombre del tipo de caja';


--
-- Name: COLUMN tipos_cajas.contratista_id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN tipos_cajas.contratista_id IS 'Clave foranea a la tabla de Contratista';


--
-- Name: COLUMN tipos_cajas.ano; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN tipos_cajas.ano IS 'Año de la entrada';


--
-- Name: COLUMN tipos_cajas.activo; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN tipos_cajas.activo IS 'Si la entrada esta o no activa.';


--
-- Name: tipo_caja_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE tipo_caja_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipo_caja_id_seq OWNER TO eureka;

--
-- Name: tipo_caja_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE tipo_caja_id_seq OWNED BY tipos_cajas.id;


--
-- Name: tipos_deudores; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE tipos_deudores (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    "descripción" character varying(255) NOT NULL,
    activo boolean DEFAULT true
);


ALTER TABLE public.tipos_deudores OWNER TO eureka;

--
-- Name: TABLE tipos_deudores; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON TABLE tipos_deudores IS 'Tipos de deudores de la empresa';


--
-- Name: COLUMN tipos_deudores.id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN tipos_deudores.id IS 'Clave primaria';


--
-- Name: COLUMN tipos_deudores.nombre; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN tipos_deudores.nombre IS 'Nombre del tipo de deudor';


--
-- Name: COLUMN tipos_deudores."descripción"; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN tipos_deudores."descripción" IS 'Descripción del tipo de deudor';


--
-- Name: COLUMN tipos_deudores.activo; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN tipos_deudores.activo IS 'Si el registro esta habilitado o no';


--
-- Name: tipos_deudores_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE tipos_deudores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipos_deudores_id_seq OWNER TO eureka;

--
-- Name: tipos_deudores_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE tipos_deudores_id_seq OWNED BY tipos_deudores.id;


--
-- Name: tipos_inversiones; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE tipos_inversiones (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    activo boolean NOT NULL,
    ano date DEFAULT now(),
    descripcion character varying(255)
);


ALTER TABLE public.tipos_inversiones OWNER TO eureka;

--
-- Name: TABLE tipos_inversiones; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON TABLE tipos_inversiones IS 'Tabla que contiene todos los tipos de inversiones a colocar por los contratistas';


--
-- Name: COLUMN tipos_inversiones.id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN tipos_inversiones.id IS 'Clave primaria';


--
-- Name: COLUMN tipos_inversiones.nombre; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN tipos_inversiones.nombre IS 'Nombre de la inversion a colocar';


--
-- Name: COLUMN tipos_inversiones.activo; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN tipos_inversiones.activo IS 'Si el registro esta o no activo';


--
-- Name: COLUMN tipos_inversiones.descripcion; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN tipos_inversiones.descripcion IS 'Descripcion en caso de que se requiera mostrar informacion adicional al contratista';


--
-- Name: tipos_inversiones_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE tipos_inversiones_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipos_inversiones_id_seq OWNER TO eureka;

--
-- Name: tipos_inversiones_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE tipos_inversiones_id_seq OWNED BY tipos_inversiones.id;


--
-- Name: tipos_sustentos; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE tipos_sustentos (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    tipo_cuenta character varying(200) NOT NULL,
    activo boolean DEFAULT true,
    ano date DEFAULT now()
);


ALTER TABLE public.tipos_sustentos OWNER TO eureka;

--
-- Name: TABLE tipos_sustentos; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON TABLE tipos_sustentos IS 'Tabla donde se encuentran almacenados todos los sustentos que soportan la informacion cargada asociada a su respectiva cuenta.';


--
-- Name: COLUMN tipos_sustentos.id; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN tipos_sustentos.id IS 'Clave primaria';


--
-- Name: COLUMN tipos_sustentos.nombre; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN tipos_sustentos.nombre IS 'Nombre del sustento';


--
-- Name: COLUMN tipos_sustentos.tipo_cuenta; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN tipos_sustentos.tipo_cuenta IS 'La cuenta a la cual pertenece el requisito';


--
-- Name: COLUMN tipos_sustentos.activo; Type: COMMENT; Schema: public; Owner: eureka
--

COMMENT ON COLUMN tipos_sustentos.activo IS 'Si el registro esta o no activo.';


--
-- Name: tipos_sustentos_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE tipos_sustentos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipos_sustentos_id_seq OWNER TO eureka;

--
-- Name: tipos_sustentos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE tipos_sustentos_id_seq OWNED BY tipos_sustentos.id;


--
-- Name: user; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE "user" (
    id integer NOT NULL,
    username character varying(255) NOT NULL,
    auth_key character varying(32) NOT NULL,
    password_hash character varying(255) NOT NULL,
    password_reset_token character varying(255),
    email character varying(255) NOT NULL,
    status smallint DEFAULT 10 NOT NULL,
    created_at integer NOT NULL,
    updated_at integer NOT NULL
);


ALTER TABLE public."user" OWNER TO eureka;

--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: eureka
--

CREATE SEQUENCE user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_id_seq OWNER TO eureka;

--
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eureka
--

ALTER SEQUENCE user_id_seq OWNED BY "user".id;


--
-- Name: variables_globales; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE variables_globales (
    id integer NOT NULL,
    contratista_id integer NOT NULL,
    campo character varying(255) NOT NULL,
    cuenta_afectada integer NOT NULL,
    valor character varying(255) NOT NULL,
    ano date DEFAULT now()
);


ALTER TABLE public.variables_globales OWNER TO postgres;

--
-- Name: TABLE variables_globales; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE variables_globales IS 'Tabla que almacena la informacion por contratista de los campos de algunas cuentas';


--
-- Name: COLUMN variables_globales.id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN variables_globales.id IS 'Clave primaria';


--
-- Name: COLUMN variables_globales.contratista_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN variables_globales.contratista_id IS 'FK:id para obtener la variable por cada contratista';


--
-- Name: COLUMN variables_globales.campo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN variables_globales.campo IS 'Campo a relacionar por la cuenta';


--
-- Name: COLUMN variables_globales.cuenta_afectada; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN variables_globales.cuenta_afectada IS 'Numero del modelo que afecta al campo';


--
-- Name: variables_globales_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE variables_globales_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.variables_globales_id_seq OWNER TO postgres;

--
-- Name: variables_globales_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE variables_globales_id_seq OWNED BY variables_globales.id;


--
-- Name: vs_database_diagrams; Type: TABLE; Schema: public; Owner: eureka; Tablespace: 
--

CREATE TABLE vs_database_diagrams (
    name character varying(80),
    diadata text,
    comment character varying(1022),
    preview text,
    lockinfo character varying(80),
    locktime timestamp with time zone,
    version character varying(80)
);


ALTER TABLE public.vs_database_diagrams OWNER TO eureka;

--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY accionistas ALTER COLUMN id SET DEFAULT nextval('accionistas_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY bancos ALTER COLUMN id SET DEFAULT nextval('"Bancos_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY bancos_contratistas ALTER COLUMN id SET DEFAULT nextval('bancos_contratistas_id_seq'::regclass);


--
-- Name: contratista_id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY bancos_contratistas ALTER COLUMN contratista_id SET DEFAULT nextval('bancos_contratistas_contratista_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY clientes ALTER COLUMN id SET DEFAULT nextval('clientes_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY contratistas ALTER COLUMN id SET DEFAULT nextval('contratistas_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY cuentas ALTER COLUMN id SET DEFAULT nextval('cuentas_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY cuentas_cobrar_sprivpub ALTER COLUMN id SET DEFAULT nextval('cuentas_cobrar_spri_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY directores ALTER COLUMN id SET DEFAULT nextval('directores_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY efectivo_banco ALTER COLUMN id SET DEFAULT nextval('efectivo_banco_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY efectivo_caja ALTER COLUMN id SET DEFAULT nextval('efectivo_caja_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY empresas_relacionadas ALTER COLUMN id SET DEFAULT nextval('empresas_relacionadas_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY gastos_pag_ant ALTER COLUMN id SET DEFAULT nextval('gastos_pag_ant_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY inpc ALTER COLUMN id SET DEFAULT nextval('inpc_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY inventarios ALTER COLUMN id SET DEFAULT nextval('inventario_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY inventarios_c ALTER COLUMN id SET DEFAULT nextval('inventarios_c_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY inversiones ALTER COLUMN id SET DEFAULT nextval('inversiones_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY notas_revelatorias ALTER COLUMN id SET DEFAULT nextval('notas_revelatorias_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY otras_cuentas_cobrar ALTER COLUMN id SET DEFAULT nextval('cuentas_por_cobrar_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY personas_juridicas ALTER COLUMN id SET DEFAULT nextval('empresas_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY personas_naturales ALTER COLUMN id SET DEFAULT nextval('personas_naturales_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY reps_legales ALTER COLUMN id SET DEFAULT nextval('reps_legales_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY sustento_conts ALTER COLUMN id SET DEFAULT nextval('sustento_cont_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY tipos_cajas ALTER COLUMN id SET DEFAULT nextval('tipo_caja_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY tipos_deudores ALTER COLUMN id SET DEFAULT nextval('tipos_deudores_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY tipos_inversiones ALTER COLUMN id SET DEFAULT nextval('tipos_inversiones_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY tipos_sustentos ALTER COLUMN id SET DEFAULT nextval('tipos_sustentos_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY "user" ALTER COLUMN id SET DEFAULT nextval('user_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY variables_globales ALTER COLUMN id SET DEFAULT nextval('variables_globales_id_seq'::regclass);


--
-- Name: Bancos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('"Bancos_id_seq"', 1, false);


--
-- Data for Name: accionistas; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY accionistas (id, persona_natural_id, contratista_id) FROM stdin;
\.


--
-- Name: accionistas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('accionistas_id_seq', 1, false);


--
-- Data for Name: bancos; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY bancos (id, nombre, rif, codigo_sudeban) FROM stdin;
\.


--
-- Data for Name: bancos_contratistas; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY bancos_contratistas (id, banco_id, contratista_id, num_cuenta, ano, activo) FROM stdin;
\.


--
-- Name: bancos_contratistas_contratista_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('bancos_contratistas_contratista_id_seq', 1, false);


--
-- Name: bancos_contratistas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('bancos_contratistas_id_seq', 1, false);


--
-- Data for Name: clientes; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY clientes (id, nombre, rif, publico, contratista_id) FROM stdin;
\.


--
-- Name: clientes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('clientes_id_seq', 1, false);


--
-- Data for Name: contratistas; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY contratistas (id, empresa_id) FROM stdin;
\.


--
-- Name: contratistas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('contratistas_id_seq', 1, false);


--
-- Data for Name: cuentas; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY cuentas (id, nombre) FROM stdin;
\.


--
-- Name: cuentas_cobrar_spri_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('cuentas_cobrar_spri_id_seq', 1, false);


--
-- Data for Name: cuentas_cobrar_sprivpub; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY cuentas_cobrar_sprivpub (id, venta, servicio, obras, num_contrato_factura, monto_contrato_f, procentaje_a, plazo_contrato, contatista_id, ano, tipo_cuenta) FROM stdin;
\.


--
-- Name: cuentas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('cuentas_id_seq', 1, false);


--
-- Name: cuentas_por_cobrar_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('cuentas_por_cobrar_id_seq', 1, false);


--
-- Data for Name: directores; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY directores (id, persona_natural_id, contratista_id, miembro_junta) FROM stdin;
\.


--
-- Name: directores_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('directores_id_seq', 1, false);


--
-- Data for Name: efectivo_banco; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY efectivo_banco (id, contratista_id, banco_id, saldo_banco, depos_transito, che_transito, nd_contabilizadas, nc_contabilizadas, ano, activo) FROM stdin;
\.


--
-- Name: efectivo_banco_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('efectivo_banco_id_seq', 1, false);


--
-- Data for Name: efectivo_caja; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY efectivo_caja (id, contratista_id, ano, tipo, tipo_caja_id, activo) FROM stdin;
\.


--
-- Name: efectivo_caja_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('efectivo_caja_id_seq', 2, true);


--
-- Name: empresas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('empresas_id_seq', 1, false);


--
-- Data for Name: empresas_relacionadas; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY empresas_relacionadas (id, empresa_id, contratista_id, otras_cuentas_pagar_id, participacion) FROM stdin;
\.


--
-- Name: empresas_relacionadas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('empresas_relacionadas_id_seq', 1, false);


--
-- Data for Name: gastos_pag_ant; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY gastos_pag_ant (id, gastos, ref_proveedor_ppal, saldo_per_ant, importe_contratado_per, reintegro_apli_amorti, saldo_contabilidad, ano) FROM stdin;
\.


--
-- Name: gastos_pag_ant_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('gastos_pag_ant_id_seq', 1, false);


--
-- Data for Name: inpc; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY inpc (id, mes, indice, ano) FROM stdin;
\.


--
-- Name: inpc_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('inpc_id_seq', 2, true);


--
-- Name: inventario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('inventario_id_seq', 1, false);


--
-- Data for Name: inventarios; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY inventarios (id, tec_med_costo, for_cal_costo, costo_adquisicion, ajuste_inflacion, reverso_deterioro, saldo_contabilidad, inventario) FROM stdin;
\.


--
-- Data for Name: inventarios_c; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY inventarios_c (id, tecnica_medicion, formula_calculo, costo_adquisicion, ajuste_inflacion, reservo_deterioro, contratista_id, ano) FROM stdin;
\.


--
-- Name: inventarios_c_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('inventarios_c_id_seq', 1, false);


--
-- Data for Name: inversiones; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY inversiones (id, banco_id, costo_adquisicion, valor_desvalorizacion, contratista_id, ano, activo, plazo, tasa_interes, tipo_inversion) FROM stdin;
\.


--
-- Name: inversiones_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('inversiones_id_seq', 1, false);


--
-- Data for Name: migration; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY migration (version, apply_time) FROM stdin;
m000000_000000_base	1421935528
m130524_201442_init	1421935677
\.


--
-- Data for Name: notas_revelatorias; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY notas_revelatorias (id, nota, usuario_id, contratista_id, ano, cuenta) FROM stdin;
\.


--
-- Name: notas_revelatorias_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('notas_revelatorias_id_seq', 1, false);


--
-- Data for Name: otras_cuentas_cobrar; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY otras_cuentas_cobrar (id, tipo_deudor_id, nombre, origen, fecha, garantia, plazo, ano, contratista_id, activo) FROM stdin;
\.


--
-- Data for Name: personas_juridicas; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY personas_juridicas (id, nombre, rif) FROM stdin;
\.


--
-- Data for Name: personas_naturales; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY personas_naturales (id, nombre, cedula) FROM stdin;
\.


--
-- Name: personas_naturales_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('personas_naturales_id_seq', 1, false);


--
-- Data for Name: reps_legales; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY reps_legales (id, persona_natural_id, contratista_id) FROM stdin;
\.


--
-- Name: reps_legales_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('reps_legales_id_seq', 1, false);


--
-- Name: sustento_cont_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('sustento_cont_id_seq', 1, false);


--
-- Data for Name: sustento_conts; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY sustento_conts (id, descripcion, tipo_sustento_id, contratista_id, ano) FROM stdin;
\.


--
-- Name: tipo_caja_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('tipo_caja_id_seq', 1, false);


--
-- Data for Name: tipos_cajas; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY tipos_cajas (id, nombre, contratista_id, ano, activo) FROM stdin;
\.


--
-- Data for Name: tipos_deudores; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY tipos_deudores (id, nombre, "descripción", activo) FROM stdin;
\.


--
-- Name: tipos_deudores_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('tipos_deudores_id_seq', 1, false);


--
-- Data for Name: tipos_inversiones; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY tipos_inversiones (id, nombre, activo, ano, descripcion) FROM stdin;
\.


--
-- Name: tipos_inversiones_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('tipos_inversiones_id_seq', 1, false);


--
-- Data for Name: tipos_sustentos; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY tipos_sustentos (id, nombre, tipo_cuenta, activo, ano) FROM stdin;
\.


--
-- Name: tipos_sustentos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('tipos_sustentos_id_seq', 1, false);


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY "user" (id, username, auth_key, password_hash, password_reset_token, email, status, created_at, updated_at) FROM stdin;
1	Socram	4kH_mD4-Tpa4ejuFTJMLF7PGQcjcEZKE	$2y$13$3qeCtM6k32qRC9VavJTba.Brf6FharoxWEuEse/sxWXkKFuyjMljW	\N	marcospha@gmail.com	10	1421935798	1421935798
2	edgarleal	n6Rg3s0vFg7UG_OgUKF_arH9oO7puc3z	$2y$13$HakXwwyVVCaCGNf2VJ1...G0uHs5wzJgoukmAGS1u.xD/S0aYBngy	Efv0S4j4_FacWNrzHz1Sng7PUCDIhIsS_1422657846	edgar.leal0@gmail.com	10	1422657828	1422657846
\.


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: eureka
--

SELECT pg_catalog.setval('user_id_seq', 2, true);


--
-- Data for Name: variables_globales; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY variables_globales (id, contratista_id, campo, cuenta_afectada, valor, ano) FROM stdin;
\.


--
-- Name: variables_globales_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('variables_globales_id_seq', 1, false);


--
-- Data for Name: vs_database_diagrams; Type: TABLE DATA; Schema: public; Owner: eureka
--

COPY vs_database_diagrams (name, diadata, comment, preview, lockinfo, locktime, version) FROM stdin;
rnc	PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHByb3BlcnRpZXM+Cgk8Q29udHJvbHM+CgkJPFRhYmxlPgoJCQk8UGFyZW50IHZhbHVlPSIjVE9QIi8+CgkJCTxQcm9wZXJ0aWVzPgoJCQkJPF5jaGVja3MgdmFsdWU9IjAiLz4KCQkJCTxeZ3JvdXAgdmFsdWU9Ii0xIi8+CgkJCQk8XmhlaWdodCB2YWx1ZT0iLTEiLz4KCQkJCTxeaW5kZXhlcyB2YWx1ZT0iMCIvPgoJCQkJPF5sZXZlbCB2YWx1ZT0iOCIvPgoJCQkJPF5saW5rcyB2YWx1ZT0iMCIvPgoJCQkJPF5sb2NrIHZhbHVlPSIwIi8+CgkJCQk8Xm1ldGhvZHMgdmFsdWU9IjAiLz4KCQkJCTxebWluaW1pemVkIHZhbHVlPSIwIi8+CgkJCQk8XnByb3BlcnRpZXMgdmFsdWU9IjAiLz4KCQkJCTxedHJpZ2dlcnMgdmFsdWU9IjAiLz4KCQkJCTxedW5pcXVlcyB2YWx1ZT0iMCIvPgoJCQkJPGJhY2tfY29sb3IgdmFsdWU9IkI0RDY0NzAwIi8+CgkJCQk8bmFtZSB2YWx1ZT0iVGFibGUiLz4KCQkJCTxwb3NpdGlvbiB2YWx1ZT0iMzg7MzYiLz4KCQkJCTxzaXplIHZhbHVlPSIxOTc7ODYiLz4KCQkJPC9Qcm9wZXJ0aWVzPgoJCQk8VHlwZSB2YWx1ZT0iVGFibGUiLz4KCQk8L1RhYmxlPgoJCTxUYWJsZTE+CgkJCTxQYXJlbnQgdmFsdWU9IiNUT1AiLz4KCQkJPFByb3BlcnRpZXM+CgkJCQk8XmNoZWNrcyB2YWx1ZT0iMCIvPgoJCQkJPF5ncm91cCB2YWx1ZT0iLTEiLz4KCQkJCTxeaGVpZ2h0IHZhbHVlPSItMSIvPgoJCQkJPF5pbmRleGVzIHZhbHVlPSIwIi8+CgkJCQk8XmxldmVsIHZhbHVlPSI3Ii8+CgkJCQk8XmxpbmtzIHZhbHVlPSIwIi8+CgkJCQk8XmxvY2sgdmFsdWU9IjAiLz4KCQkJCTxebWV0aG9kcyB2YWx1ZT0iMCIvPgoJCQkJPF5taW5pbWl6ZWQgdmFsdWU9IjAiLz4KCQkJCTxecHJvcGVydGllcyB2YWx1ZT0iMCIvPgoJCQkJPF50cmlnZ2VycyB2YWx1ZT0iMCIvPgoJCQkJPF51bmlxdWVzIHZhbHVlPSIwIi8+CgkJCQk8YmFja19jb2xvciB2YWx1ZT0iQjRENjQ3MDAiLz4KCQkJCTxuYW1lIHZhbHVlPSJUYWJsZTEiLz4KCQkJCTxwb3NpdGlvbiB2YWx1ZT0iMzA7MjI1Ii8+CgkJCQk8c2l6ZSB2YWx1ZT0iMjMxOzEyMiIvPgoJCQk8L1Byb3BlcnRpZXM+CgkJCTxUeXBlIHZhbHVlPSJUYWJsZSIvPgoJCTwvVGFibGUxPgoJCTxUYWJsZTI+CgkJCTxQYXJlbnQgdmFsdWU9IiNUT1AiLz4KCQkJPFByb3BlcnRpZXM+CgkJCQk8XmNoZWNrcyB2YWx1ZT0iMCIvPgoJCQkJPF5ncm91cCB2YWx1ZT0iLTEiLz4KCQkJCTxeaGVpZ2h0IHZhbHVlPSItMSIvPgoJCQkJPF5pbmRleGVzIHZhbHVlPSIwIi8+CgkJCQk8XmxldmVsIHZhbHVlPSI2Ii8+CgkJCQk8XmxpbmtzIHZhbHVlPSIwIi8+CgkJCQk8XmxvY2sgdmFsdWU9IjAiLz4KCQkJCTxebWV0aG9kcyB2YWx1ZT0iMCIvPgoJCQkJPF5taW5pbWl6ZWQgdmFsdWU9IjAiLz4KCQkJCTxecHJvcGVydGllcyB2YWx1ZT0iMCIvPgoJCQkJPF50cmlnZ2VycyB2YWx1ZT0iMCIvPgoJCQkJPF51bmlxdWVzIHZhbHVlPSIwIi8+CgkJCQk8YmFja19jb2xvciB2YWx1ZT0iQjRENjQ3MDAiLz4KCQkJCTxuYW1lIHZhbHVlPSJUYWJsZTIiLz4KCQkJCTxwb3NpdGlvbiB2YWx1ZT0iODU7MTMzIi8+CgkJCQk8c2l6ZSB2YWx1ZT0iMjA4OzY4Ii8+CgkJCTwvUHJvcGVydGllcz4KCQkJPFR5cGUgdmFsdWU9IlRhYmxlIi8+CgkJPC9UYWJsZTI+CgkJPFRhYmxlMz4KCQkJPFBhcmVudCB2YWx1ZT0iI1RPUCIvPgoJCQk8UHJvcGVydGllcz4KCQkJCTxeY2hlY2tzIHZhbHVlPSIwIi8+CgkJCQk8Xmdyb3VwIHZhbHVlPSItMSIvPgoJCQkJPF5oZWlnaHQgdmFsdWU9Ii0xIi8+CgkJCQk8XmluZGV4ZXMgdmFsdWU9IjAiLz4KCQkJCTxebGV2ZWwgdmFsdWU9IjUiLz4KCQkJCTxebGlua3MgdmFsdWU9IjAiLz4KCQkJCTxebG9jayB2YWx1ZT0iMCIvPgoJCQkJPF5tZXRob2RzIHZhbHVlPSIwIi8+CgkJCQk8Xm1pbmltaXplZCB2YWx1ZT0iMCIvPgoJCQkJPF5wcm9wZXJ0aWVzIHZhbHVlPSIwIi8+CgkJCQk8XnRyaWdnZXJzIHZhbHVlPSIwIi8+CgkJCQk8XnVuaXF1ZXMgdmFsdWU9IjAiLz4KCQkJCTxiYWNrX2NvbG9yIHZhbHVlPSJCNEQ2NDcwMCIvPgoJCQkJPG5hbWUgdmFsdWU9IlRhYmxlMyIvPgoJCQkJPHBvc2l0aW9uIHZhbHVlPSI0Mzs0NDIiLz4KCQkJCTxzaXplIHZhbHVlPSIxMjY7NTAiLz4KCQkJPC9Qcm9wZXJ0aWVzPgoJCQk8VHlwZSB2YWx1ZT0iVGFibGUiLz4KCQk8L1RhYmxlMz4KCQk8VGFibGU0PgoJCQk8UGFyZW50IHZhbHVlPSIjVE9QIi8+CgkJCTxQcm9wZXJ0aWVzPgoJCQkJPF5jaGVja3MgdmFsdWU9IjAiLz4KCQkJCTxeZ3JvdXAgdmFsdWU9Ii0xIi8+CgkJCQk8XmhlaWdodCB2YWx1ZT0iLTEiLz4KCQkJCTxeaW5kZXhlcyB2YWx1ZT0iMCIvPgoJCQkJPF5sZXZlbCB2YWx1ZT0iNCIvPgoJCQkJPF5saW5rcyB2YWx1ZT0iMCIvPgoJCQkJPF5sb2NrIHZhbHVlPSIwIi8+CgkJCQk8Xm1ldGhvZHMgdmFsdWU9IjAiLz4KCQkJCTxebWluaW1pemVkIHZhbHVlPSIwIi8+CgkJCQk8XnByb3BlcnRpZXMgdmFsdWU9IjAiLz4KCQkJCTxedHJpZ2dlcnMgdmFsdWU9IjAiLz4KCQkJCTxedW5pcXVlcyB2YWx1ZT0iMCIvPgoJCQkJPGJhY2tfY29sb3IgdmFsdWU9IkI0RDY0NzAwIi8+CgkJCQk8bmFtZSB2YWx1ZT0iVGFibGU0Ii8+CgkJCQk8cG9zaXRpb24gdmFsdWU9IjEzMDszNTQiLz4KCQkJCTxzaXplIHZhbHVlPSIyMTY7MTU4Ii8+CgkJCTwvUHJvcGVydGllcz4KCQkJPFR5cGUgdmFsdWU9IlRhYmxlIi8+CgkJPC9UYWJsZTQ+CgkJPFRhYmxlNT4KCQkJPFBhcmVudCB2YWx1ZT0iI1RPUCIvPgoJCQk8UHJvcGVydGllcz4KCQkJCTxeY2hlY2tzIHZhbHVlPSIwIi8+CgkJCQk8Xmdyb3VwIHZhbHVlPSItMSIvPgoJCQkJPF5oZWlnaHQgdmFsdWU9Ii0xIi8+CgkJCQk8XmluZGV4ZXMgdmFsdWU9IjAiLz4KCQkJCTxebGV2ZWwgdmFsdWU9IjMiLz4KCQkJCTxebGlua3MgdmFsdWU9IjAiLz4KCQkJCTxebG9jayB2YWx1ZT0iMCIvPgoJCQkJPF5tZXRob2RzIHZhbHVlPSIwIi8+CgkJCQk8Xm1pbmltaXplZCB2YWx1ZT0iMCIvPgoJCQkJPF5wcm9wZXJ0aWVzIHZhbHVlPSIwIi8+CgkJCQk8XnRyaWdnZXJzIHZhbHVlPSIwIi8+CgkJCQk8XnVuaXF1ZXMgdmFsdWU9IjAiLz4KCQkJCTxiYWNrX2NvbG9yIHZhbHVlPSJCNEQ2NDcwMCIvPgoJCQkJPG5hbWUgdmFsdWU9IlRhYmxlNSIvPgoJCQkJPHBvc2l0aW9uIHZhbHVlPSIyNjY7MjA2Ii8+CgkJCQk8c2l6ZSB2YWx1ZT0iMjQ4OzIxMiIvPgoJCQk8L1Byb3BlcnRpZXM+CgkJCTxUeXBlIHZhbHVlPSJUYWJsZSIvPgoJCTwvVGFibGU1PgoJCTxUYWJsZTY+CgkJCTxQYXJlbnQgdmFsdWU9IiNUT1AiLz4KCQkJPFByb3BlcnRpZXM+CgkJCQk8XmNoZWNrcyB2YWx1ZT0iMCIvPgoJCQkJPF5ncm91cCB2YWx1ZT0iLTEiLz4KCQkJCTxeaGVpZ2h0IHZhbHVlPSItMSIvPgoJCQkJPF5pbmRleGVzIHZhbHVlPSIwIi8+CgkJCQk8XmxldmVsIHZhbHVlPSIyIi8+CgkJCQk8XmxpbmtzIHZhbHVlPSIwIi8+CgkJCQk8XmxvY2sgdmFsdWU9IjAiLz4KCQkJCTxebWV0aG9kcyB2YWx1ZT0iMCIvPgoJCQkJPF5taW5pbWl6ZWQgdmFsdWU9IjAiLz4KCQkJCTxecHJvcGVydGllcyB2YWx1ZT0iMCIvPgoJCQkJPF50cmlnZ2VycyB2YWx1ZT0iMCIvPgoJCQkJPF51bmlxdWVzIHZhbHVlPSIwIi8+CgkJCQk8YmFja19jb2xvciB2YWx1ZT0iQjRENjQ3MDAiLz4KCQkJCTxuYW1lIHZhbHVlPSJUYWJsZTYiLz4KCQkJCTxwb3NpdGlvbiB2YWx1ZT0iMjYzOzExIi8+CgkJCQk8c2l6ZSB2YWx1ZT0iMjc5OzIxMiIvPgoJCQk8L1Byb3BlcnRpZXM+CgkJCTxUeXBlIHZhbHVlPSJUYWJsZSIvPgoJCTwvVGFibGU2PgoJCTxUYWJsZTc+CgkJCTxQYXJlbnQgdmFsdWU9IiNUT1AiLz4KCQkJPFByb3BlcnRpZXM+CgkJCQk8XmNoZWNrcyB2YWx1ZT0iMCIvPgoJCQkJPF5ncm91cCB2YWx1ZT0iLTEiLz4KCQkJCTxeaGVpZ2h0IHZhbHVlPSItMSIvPgoJCQkJPF5pbmRleGVzIHZhbHVlPSIwIi8+CgkJCQk8XmxldmVsIHZhbHVlPSIxIi8+CgkJCQk8XmxpbmtzIHZhbHVlPSIwIi8+CgkJCQk8XmxvY2sgdmFsdWU9IjAiLz4KCQkJCTxebWV0aG9kcyB2YWx1ZT0iMCIvPgoJCQkJPF5taW5pbWl6ZWQgdmFsdWU9IjAiLz4KCQkJCTxecHJvcGVydGllcyB2YWx1ZT0iMCIvPgoJCQkJPF50cmlnZ2VycyB2YWx1ZT0iMCIvPgoJCQkJPF51bmlxdWVzIHZhbHVlPSIwIi8+CgkJCQk8YmFja19jb2xvciB2YWx1ZT0iQjRENjQ3MDAiLz4KCQkJCTxuYW1lIHZhbHVlPSJUYWJsZTciLz4KCQkJCTxwb3NpdGlvbiB2YWx1ZT0iODU7MzEwIi8+CgkJCQk8c2l6ZSB2YWx1ZT0iMjE4OzIzMCIvPgoJCQk8L1Byb3BlcnRpZXM+CgkJCTxUeXBlIHZhbHVlPSJUYWJsZSIvPgoJCTwvVGFibGU3PgoJCTxybmM+CgkJCTxQcm9wZXJ0aWVzPgoJCQkJPF5sb2NrIHZhbHVlPSIwIi8+CgkJCQk8YmFja19jb2xvciB2YWx1ZT0iRkZGRkZGIi8+CgkJCQk8Z2FtbWEgdmFsdWU9IjAiLz4KCQkJCTxuYW1lIHZhbHVlPSJybmMiLz4KCQkJCTxzaXplIHZhbHVlPSIyMDQ4OzIwNDgiLz4KCQkJCTxzdHlsZSB2YWx1ZT0iNCIvPgoJCQkJPHN0eWxlX2xpbmtzIHZhbHVlPSIwIi8+CgkJCQk8dW5pdHMgdmFsdWU9IjUiLz4KCQkJPC9Qcm9wZXJ0aWVzPgoJCQk8VHlwZSB2YWx1ZT0iRGlhZ3JhbSIvPgoJCTwvcm5jPgoJPC9Db250cm9scz4KCTxHVUk+CgkJPEZ1bGxUb29sYmFyTGVmdCB2YWx1ZT0iMSIvPgoJCTxGdWxsVG9vbGJhclJpZ2h0IHZhbHVlPSIxIi8+CgkJPFBhZ2VFZGl0b3IgdmFsdWU9Ii0xIi8+CgkJPFBhZ2VFZGl0b3JIIHZhbHVlPSIwIi8+CgkJPFBhZ2VUb29sYmFyTGVmdCB2YWx1ZT0iMCIvPgoJCTxQYWdlVG9vbGJhclJCIHZhbHVlPSIwIi8+CgkJPFBhZ2VUb29sYmFyUmlnaHQgdmFsdWU9IjAiLz4KCQk8UGFuZUNsaXBib2FyZCB2YWx1ZT0iMCIvPgoJCTxQYW5lTGF5b3V0IHZhbHVlPSIwIi8+CgkJPFBhbmVWaWV3IHZhbHVlPSIwIi8+CgkJPFNjcm9sbFggdmFsdWU9IjAiLz4KCQk8U2Nyb2xsWSB2YWx1ZT0iMCIvPgoJCTxTZWxlY3Rpb24gdmFsdWU9IlZHRmliR1UzIi8+CgkJPFNob3dBbGwgdmFsdWU9IjEiLz4KCQk8U2hvd0NoYW5nZXMgdmFsdWU9IjEiLz4KCQk8U2hvd0dMIHZhbHVlPSIxIi8+CgkJPFNob3dHcmlkIHZhbHVlPSIxIi8+CgkJPFVzZUdyaWQgdmFsdWU9IjAiLz4KCTwvR1VJPgoJPE1vZGVsPgoJCTxwdWJsaWM+CgkJCTx0YWJsZT4KCQkJCTxvMD4KCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCTxDaGVja19Db3VudCB2YWx1ZT0iMCIvPgoJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCTxGaWVsZF9Db3VudCB2YWx1ZT0iMyIvPgoJCQkJCQk8SGFzX09JRHMgdmFsdWU9IjAiLz4KCQkJCQkJPElEIHZhbHVlPSI2MDA3MyIvPgoJCQkJCQk8SW5kZXhfQ291bnQgdmFsdWU9IjAiLz4KCQkJCQkJPExpbmtfQ291bnQgdmFsdWU9IjAiLz4KCQkJCQkJPE5hbWUgdmFsdWU9ImJhbmNvcyIvPgoJCQkJCQk8T2JqZWN0X093bmVyIHZhbHVlPSJldXJla2EiLz4KCQkJCQkJPFByaW1hcnlfS2V5IHZhbHVlPSJhV1E9Ii8+CgkJCQkJCTxQcmltYXJ5X0tleV9OYW1lIHZhbHVlPSJCYW5jb3NfcGtleSIvPgoJCQkJCQk8UmVjb3JkX0NvdW50IHZhbHVlPSIwIi8+CgkJCQkJCTxTY2hlbWEgdmFsdWU9InB1YmxpYyIvPgoJCQkJCQk8VHJpZ2dlcl9Db3VudCB2YWx1ZT0iMCIvPgoJCQkJCQk8VW5pcXVlX0NvdW50IHZhbHVlPSIwIi8+CgkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCTxjb250cm9sIHZhbHVlPSJUYWJsZSIvPgoJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQk8ZmllbGQ+CgkJCQkJCTxvMD4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9IiIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSJDbGF2ZSBwcmltYXJpYSIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSduZXh0dmFsKCZhcG9zOyJCYW5jb3NfaWRfc2VxIiZhcG9zOzo6cmVnY2xhc3MpJy8+CgkJCQkJCQkJPERpbWVuc2lvbnMgdmFsdWU9IjAiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjEiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJpZCIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJJbnRlZ2VyIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMSIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImlkIi8+CgkJCQkJCTwvbzA+CgkJCQkJCTxvMT4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9JyJwZ19jYXRhbG9nIi4iZGVmYXVsdCInLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iTm9tYnJlIGRlbCBiYW5jbyIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RGltZW5zaW9ucyB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMiIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iMjU1Ii8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9Im5vbWJyZSIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJDaGFyYWN0ZXIgVmFyeWluZyIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJub21icmUiLz4KCQkJCQkJPC9vMT4KCQkJCQkJPG8yPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0nInBnX2NhdGFsb2ciLiJkZWZhdWx0IicvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSJSaWYgZGVsIGJhbmNvIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxEaW1lbnNpb25zIHZhbHVlPSIwIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSIzIi8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8TGVuZ3RoIHZhbHVlPSIxMDAiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0icmlmIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkNoYXJhY3RlciBWYXJ5aW5nIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9InJpZiIvPgoJCQkJCQk8L28yPgoJCQkJCTwvZmllbGQ+CgkJCQkJPGlkIHZhbHVlPSI2MDA3MyIvPgoJCQkJCTxuYW1lIHZhbHVlPSJiYW5jb3MiLz4KCQkJCTwvbzA+CgkJCQk8bzE+CgkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQk8Q2hlY2tfQ291bnQgdmFsdWU9IjAiLz4KCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQk8RmllbGRfQ291bnQgdmFsdWU9IjUiLz4KCQkJCQkJPEhhc19PSURzIHZhbHVlPSIwIi8+CgkJCQkJCTxJRCB2YWx1ZT0iNjAwNzgiLz4KCQkJCQkJPEluZGV4X0NvdW50IHZhbHVlPSIwIi8+CgkJCQkJCTxMaW5rX0NvdW50IHZhbHVlPSIwIi8+CgkJCQkJCTxOYW1lIHZhbHVlPSJiYW5jb3NfY29udHJhdGlzdGFzIi8+CgkJCQkJCTxPYmplY3RfT3duZXIgdmFsdWU9ImV1cmVrYSIvPgoJCQkJCQk8UHJpbWFyeV9LZXkgdmFsdWU9ImFXUT0iLz4KCQkJCQkJPFByaW1hcnlfS2V5X05hbWUgdmFsdWU9ImJhbmNvc19jb250cmF0aXN0YXNfcGtleSIvPgoJCQkJCQk8UmVjb3JkX0NvdW50IHZhbHVlPSIwIi8+CgkJCQkJCTxTY2hlbWEgdmFsdWU9InB1YmxpYyIvPgoJCQkJCQk8VHJpZ2dlcl9Db3VudCB2YWx1ZT0iMCIvPgoJCQkJCQk8VW5pcXVlX0NvdW50IHZhbHVlPSIwIi8+CgkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCTxjb250cm9sIHZhbHVlPSJUYWJsZTEiLz4KCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJPGZpZWxkPgoJCQkJCQk8bzA+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iQcOxbyBjYXJnYWRvIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxEaW1lbnNpb25zIHZhbHVlPSIwIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSI1Ii8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iYW5vIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIxIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkRhdGUiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iYW5vIi8+CgkJCQkJCTwvbzA+CgkJCQkJCTxvMT4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9IiIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSJDbGF2ZSBmb3JhbmVhIGEgbGEgdGFibGEgQmFuY28iLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPERpbWVuc2lvbnMgdmFsdWU9IjAiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjIiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJiYW5jb19pZCIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJJbnRlZ2VyIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImJhbmNvX2lkIi8+CgkJCQkJCTwvbzE+CgkJCQkJCTxvMj4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9IiIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSJDbGF2ZSBmb3JhbmVhIGEgbGEgdGFibGEgQ29udHJhdGlzdGEiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0ibmV4dHZhbCgnYmFuY29zX2NvbnRyYXRpc3Rhc19jb250cmF0aXN0YV9pZF9zZXEnOjpyZWdjbGFzcykiLz4KCQkJCQkJCQk8RGltZW5zaW9ucyB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMyIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImNvbnRyYXRpc3RhX2lkIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkludGVnZXIiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iY29udHJhdGlzdGFfaWQiLz4KCQkJCQkJPC9vMj4KCQkJCQkJPG8zPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IkNsYXZlIHByaW1hcmlhIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9Im5leHR2YWwoJ2JhbmNvc19jb250cmF0aXN0YXNfaWRfc2VxJzo6cmVnY2xhc3MpIi8+CgkJCQkJCQkJPERpbWVuc2lvbnMgdmFsdWU9IjAiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjEiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJpZCIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJJbnRlZ2VyIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMSIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImlkIi8+CgkJCQkJCTwvbzM+CgkJCQkJCTxvND4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9JyJwZ19jYXRhbG9nIi4iZGVmYXVsdCInLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iTsO6bWVybyBkZSBjdWVudGEgYmFuY2FyaWEiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPERpbWVuc2lvbnMgdmFsdWU9IjAiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjQiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9IjE1MCIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJudW1fY3VlbnRhIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIxIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkNoYXJhY3RlciBWYXJ5aW5nIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9Im51bV9jdWVudGEiLz4KCQkJCQkJPC9vND4KCQkJCQk8L2ZpZWxkPgoJCQkJCTxpZCB2YWx1ZT0iNjAwNzgiLz4KCQkJCQk8bmFtZSB2YWx1ZT0iYmFuY29zX2NvbnRyYXRpc3RhcyIvPgoJCQkJPC9vMT4KCQkJCTxvMj4KCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCTxDaGVja19Db3VudCB2YWx1ZT0iMCIvPgoJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCTxGaWVsZF9Db3VudCB2YWx1ZT0iMiIvPgoJCQkJCQk8SGFzX09JRHMgdmFsdWU9IjAiLz4KCQkJCQkJPElEIHZhbHVlPSI1OTg4OCIvPgoJCQkJCQk8SW5kZXhfQ291bnQgdmFsdWU9IjAiLz4KCQkJCQkJPExpbmtfQ291bnQgdmFsdWU9IjAiLz4KCQkJCQkJPE5hbWUgdmFsdWU9ImNsaWVudGVzIi8+CgkJCQkJCTxPYmplY3RfT3duZXIgdmFsdWU9ImV1cmVrYSIvPgoJCQkJCQk8UHJpbWFyeV9LZXkgdmFsdWU9ImFXUT0iLz4KCQkJCQkJPFByaW1hcnlfS2V5X05hbWUgdmFsdWU9ImNsaWVudGVzX3BrIi8+CgkJCQkJCTxSZWNvcmRfQ291bnQgdmFsdWU9IjAiLz4KCQkJCQkJPFNjaGVtYSB2YWx1ZT0icHVibGljIi8+CgkJCQkJCTxUcmlnZ2VyX0NvdW50IHZhbHVlPSIwIi8+CgkJCQkJCTxVbmlxdWVfQ291bnQgdmFsdWU9IjAiLz4KCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJPGNvbnRyb2wgdmFsdWU9IlRhYmxlMiIvPgoJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQk8ZmllbGQ+CgkJCQkJCTxvMD4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9IiIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0ibmV4dHZhbCgnY2xpZW50ZXNfaWRfc2VxJzo6cmVnY2xhc3MpIi8+CgkJCQkJCQkJPERpbWVuc2lvbnMgdmFsdWU9IjAiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjEiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJpZCIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJJbnRlZ2VyIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMSIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImlkIi8+CgkJCQkJCTwvbzA+CgkJCQkJCTxvMT4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9JyJwZ19jYXRhbG9nIi4iZGVmYXVsdCInLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxEaW1lbnNpb25zIHZhbHVlPSIwIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSIyIi8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8TGVuZ3RoIHZhbHVlPSIyNTUiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0ibm9tYnJlIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIxIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkNoYXJhY3RlciBWYXJ5aW5nIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9Im5vbWJyZSIvPgoJCQkJCQk8L28xPgoJCQkJCTwvZmllbGQ+CgkJCQkJPGlkIHZhbHVlPSI1OTg4OCIvPgoJCQkJCTxuYW1lIHZhbHVlPSJjbGllbnRlcyIvPgoJCQkJPC9vMj4KCQkJCTxvMz4KCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCTxDaGVja19Db3VudCB2YWx1ZT0iMCIvPgoJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCTxGaWVsZF9Db3VudCB2YWx1ZT0iMSIvPgoJCQkJCQk8SGFzX09JRHMgdmFsdWU9IjAiLz4KCQkJCQkJPElEIHZhbHVlPSI2MDA4NSIvPgoJCQkJCQk8SW5kZXhfQ291bnQgdmFsdWU9IjAiLz4KCQkJCQkJPExpbmtfQ291bnQgdmFsdWU9IjAiLz4KCQkJCQkJPE5hbWUgdmFsdWU9ImNvbnRyYXRpc3RhcyIvPgoJCQkJCQk8T2JqZWN0X093bmVyIHZhbHVlPSJldXJla2EiLz4KCQkJCQkJPFByaW1hcnlfS2V5IHZhbHVlPSJhV1E9Ii8+CgkJCQkJCTxQcmltYXJ5X0tleV9OYW1lIHZhbHVlPSJjb250cmF0aXN0YXNfcGtleSIvPgoJCQkJCQk8UmVjb3JkX0NvdW50IHZhbHVlPSIwIi8+CgkJCQkJCTxTY2hlbWEgdmFsdWU9InB1YmxpYyIvPgoJCQkJCQk8VHJpZ2dlcl9Db3VudCB2YWx1ZT0iMCIvPgoJCQkJCQk8VW5pcXVlX0NvdW50IHZhbHVlPSIwIi8+CgkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCTxjb250cm9sIHZhbHVlPSJUYWJsZTMiLz4KCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJPGZpZWxkPgoJCQkJCQk8bzA+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iQ2xhdmUgcHJpbWFyaWEiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0ibmV4dHZhbCgnY29udHJhdGlzdGFzX2lkX3NlcSc6OnJlZ2NsYXNzKSIvPgoJCQkJCQkJCTxEaW1lbnNpb25zIHZhbHVlPSIwIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSIxIi8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjEiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iaWQiLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iSW50ZWdlciIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjEiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJpZCIvPgoJCQkJCQk8L28wPgoJCQkJCTwvZmllbGQ+CgkJCQkJPGlkIHZhbHVlPSI2MDA4NSIvPgoJCQkJCTxuYW1lIHZhbHVlPSJjb250cmF0aXN0YXMiLz4KCQkJCTwvbzM+CgkJCQk8bzQ+CgkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQk8Q2hlY2tfQ291bnQgdmFsdWU9IjAiLz4KCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQk8RmllbGRfQ291bnQgdmFsdWU9IjciLz4KCQkJCQkJPEhhc19PSURzIHZhbHVlPSIwIi8+CgkJCQkJCTxJRCB2YWx1ZT0iNjAwOTgiLz4KCQkJCQkJPEluZGV4X0NvdW50IHZhbHVlPSIwIi8+CgkJCQkJCTxMaW5rX0NvdW50IHZhbHVlPSIwIi8+CgkJCQkJCTxOYW1lIHZhbHVlPSJjdWVudGFzX2NvYnJhcl9zY29udHJhdG8iLz4KCQkJCQkJPE9iamVjdF9Pd25lciB2YWx1ZT0iZXVyZWthIi8+CgkJCQkJCTxQcmltYXJ5X0tleSB2YWx1ZT0iYVdRPSIvPgoJCQkJCQk8UHJpbWFyeV9LZXlfTmFtZSB2YWx1ZT0iY3VlbnRhc19jb2JyYXJfc2NvbnRyYXRvX3BrZXkiLz4KCQkJCQkJPFJlY29yZF9Db3VudCB2YWx1ZT0iMCIvPgoJCQkJCQk8U2NoZW1hIHZhbHVlPSJwdWJsaWMiLz4KCQkJCQkJPFRyaWdnZXJfQ291bnQgdmFsdWU9IjAiLz4KCQkJCQkJPFVuaXF1ZV9Db3VudCB2YWx1ZT0iMCIvPgoJCQkJCTwvUHJvcGVydGllcz4KCQkJCQk8Y29udHJvbCB2YWx1ZT0iVGFibGU0Ii8+CgkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCTxmaWVsZD4KCQkJCQkJPG8wPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RGltZW5zaW9ucyB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iNiIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImFubyIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJEYXRlIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImFubyIvPgoJCQkJCQk8L28wPgoJCQkJCQk8bzE+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iQ2xhdmUgZm9yYW5lYSBhIGxhIHRhYmxhIENsaWVudGVzIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxEaW1lbnNpb25zIHZhbHVlPSIwIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSI3Ii8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iY2xpZW50ZV9pZCIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJJbnRlZ2VyIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImNsaWVudGVfaWQiLz4KCQkJCQkJPC9vMT4KCQkJCQkJPG8yPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0nInBnX2NhdGFsb2ciLiJkZWZhdWx0IicvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPERpbWVuc2lvbnMgdmFsdWU9IjAiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjIiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9IjI1NSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJjb25kaWNpb25lcyIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJDaGFyYWN0ZXIgVmFyeWluZyIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJjb25kaWNpb25lcyIvPgoJCQkJCQk8L28yPgoJCQkJCQk8bzM+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iQ2xhdmUgZm9yYW5lYSBhIGxhIHRhYmxhIENvbnRyYXRpc3RhcyIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RGltZW5zaW9ucyB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iNSIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImNvbnRyYXRpc3RhX2lkIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkludGVnZXIiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iY29udHJhdGlzdGFfaWQiLz4KCQkJCQkJPC9vMz4KCQkJCQkJPG80PgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IkNsYXZlIHByaW1hcmlhIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9Im5leHR2YWwoJ2N1ZW50YXNfY29icmFyX3Njb250cmF0b19pZF9zZXEnOjpyZWdjbGFzcykiLz4KCQkJCQkJCQk8RGltZW5zaW9ucyB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIxIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImlkIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkludGVnZXIiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIxIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iaWQiLz4KCQkJCQkJPC9vND4KCQkJCQkJPG81PgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IlNhbGRvIHNlZ8O6biBjb250YWJpbGlkYWQgY29ycmllbnRlIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxEaW1lbnNpb25zIHZhbHVlPSIwIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSIzIi8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0ic2FsZG9fY29udGFfY29ycmllbnRlIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMzgiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjYiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iTnVtZXJpYyIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJzYWxkb19jb250YV9jb3JyaWVudGUiLz4KCQkJCQkJPC9vNT4KCQkJCQkJPG82PgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IlNhbGRvIHNlZ8O6biBjb250YWJpbGlkYWQgbm8gY29ycmllbnRlIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxEaW1lbnNpb25zIHZhbHVlPSIwIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSI0Ii8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0ic2FsZG9fY29udGFfbmNvcnJpZW50ZSIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjM4Ii8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSI2Ii8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9Ik51bWVyaWMiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0ic2FsZG9fY29udGFfbmNvcnJpZW50ZSIvPgoJCQkJCQk8L282PgoJCQkJCTwvZmllbGQ+CgkJCQkJPGlkIHZhbHVlPSI2MDA5OCIvPgoJCQkJCTxuYW1lIHZhbHVlPSJjdWVudGFzX2NvYnJhcl9zY29udHJhdG8iLz4KCQkJCTwvbzQ+CgkJCQk8bzU+CgkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQk8Q2hlY2tfQ291bnQgdmFsdWU9IjAiLz4KCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQk8RmllbGRfQ291bnQgdmFsdWU9IjEwIi8+CgkJCQkJCTxIYXNfT0lEcyB2YWx1ZT0iMCIvPgoJCQkJCQk8SUQgdmFsdWU9IjYwMDkwIi8+CgkJCQkJCTxJbmRleF9Db3VudCB2YWx1ZT0iMCIvPgoJCQkJCQk8TGlua19Db3VudCB2YWx1ZT0iMCIvPgoJCQkJCQk8TmFtZSB2YWx1ZT0iY3VlbnRhc19jb2JyYXJfY29udHJhdG8iLz4KCQkJCQkJPE9iamVjdF9Pd25lciB2YWx1ZT0iZXVyZWthIi8+CgkJCQkJCTxQcmltYXJ5X0tleSB2YWx1ZT0iYVdRPSIvPgoJCQkJCQk8UHJpbWFyeV9LZXlfTmFtZSB2YWx1ZT0iY3VlbnRhc19jb2JyYXJfY29udHJhdG9fcGtleSIvPgoJCQkJCQk8UmVjb3JkX0NvdW50IHZhbHVlPSIwIi8+CgkJCQkJCTxTY2hlbWEgdmFsdWU9InB1YmxpYyIvPgoJCQkJCQk8VHJpZ2dlcl9Db3VudCB2YWx1ZT0iMCIvPgoJCQkJCQk8VW5pcXVlX0NvdW50IHZhbHVlPSIwIi8+CgkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCTxjb250cm9sIHZhbHVlPSJUYWJsZTUiLz4KCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJPGZpZWxkPgoJCQkJCQk8bzA+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iQcOxbyBhIGNhcmdhciIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RGltZW5zaW9ucyB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iOSIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImFubyIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJEYXRlIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImFubyIvPgoJCQkJCQk8L28wPgoJCQkJCQk8bzE+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iQ2xhdmUgZm9yYW5lYSBhIGxhIHRhYmxhIENsaWVudGVzIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxEaW1lbnNpb25zIHZhbHVlPSIwIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSIxMCIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImNsaWVudGVfaWQiLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjEiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iSW50ZWdlciIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJjbGllbnRlX2lkIi8+CgkJCQkJCTwvbzE+CgkJCQkJCTxvMj4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9JyJwZ19jYXRhbG9nIi4iZGVmYXVsdCInLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxEaW1lbnNpb25zIHZhbHVlPSIwIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSIyIi8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8TGVuZ3RoIHZhbHVlPSIyNTUiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iY29uZGljaW9uZXMiLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iQ2hhcmFjdGVyIFZhcnlpbmciLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iY29uZGljaW9uZXMiLz4KCQkJCQkJPC9vMj4KCQkJCQkJPG8zPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IkNsYXZlIGZvcmFuZWEgYSBsYSB0YWJsYSBDb250cmF0aXN0YXMiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPERpbWVuc2lvbnMgdmFsdWU9IjAiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjgiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJjb250cmF0aXN0YV9pZCIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJJbnRlZ2VyIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImNvbnRyYXRpc3RhX2lkIi8+CgkJCQkJCTwvbzM+CgkJCQkJCTxvND4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9IiIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSJDbGF2ZSBwcmltYXJpYSIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSJuZXh0dmFsKCdjdWVudGFzX2NvYnJhcl9jb250cmF0b19pZF9zZXEnOjpyZWdjbGFzcykiLz4KCQkJCQkJCQk8RGltZW5zaW9ucyB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIxIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImlkIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkludGVnZXIiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIxIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iaWQiLz4KCQkJCQkJPC9vND4KCQkJCQkJPG81PgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0nInBnX2NhdGFsb2ciLiJkZWZhdWx0IicvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSJOw7ptZXJvIGRlIGNvbnRyYXRvIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxEaW1lbnNpb25zIHZhbHVlPSIwIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSIzIi8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8TGVuZ3RoIHZhbHVlPSIxMDAiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0ibnVtX2NvbnRyYXRvIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkNoYXJhY3RlciBWYXJ5aW5nIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9Im51bV9jb250cmF0byIvPgoJCQkJCQk8L281PgoJCQkJCQk8bzY+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPScicGdfY2F0YWxvZyIuImRlZmF1bHQiJy8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RGltZW5zaW9ucyB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iNSIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iMTAwIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9InBsYXpvX2NvbnRyYXRvIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkNoYXJhY3RlciBWYXJ5aW5nIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9InBsYXpvX2NvbnRyYXRvIi8+CgkJCQkJCTwvbzY+CgkJCQkJCTxvNz4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9JyJwZ19jYXRhbG9nIi4iZGVmYXVsdCInLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iUG9yY2VudGFqZSBkZSBhdmFuY2UiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPERpbWVuc2lvbnMgdmFsdWU9IjAiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjQiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9IjUwIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9InBvcmNlbnRhamVfYXZhbmNlIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkNoYXJhY3RlciBWYXJ5aW5nIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9InBvcmNlbnRhamVfYXZhbmNlIi8+CgkJCQkJCTwvbzc+CgkJCQkJCTxvOD4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9IiIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSJTYWxkbyBzZWfDum4gY29udGFiaWxpZGFkIGNvcnJpZW50ZSIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RGltZW5zaW9ucyB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iNiIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9InNhbGRvX2NvbnRfY29ycmllbnRlIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMzgiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjYiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iTnVtZXJpYyIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJzYWxkb19jb250X2NvcnJpZW50ZSIvPgoJCQkJCQk8L284PgoJCQkJCQk8bzk+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iU2FsZG8gc2Vnw7puIGNvbnRhYmlsaWRhZCBubyBjb3JyaWVudGUiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPERpbWVuc2lvbnMgdmFsdWU9IjAiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjciLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJzYWxkb19jb250X25jb3JyaWVudGUiLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSIzOCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iNiIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJOdW1lcmljIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9InNhbGRvX2NvbnRfbmNvcnJpZW50ZSIvPgoJCQkJCQk8L285PgoJCQkJCTwvZmllbGQ+CgkJCQkJPGlkIHZhbHVlPSI2MDA5MCIvPgoJCQkJCTxuYW1lIHZhbHVlPSJjdWVudGFzX2NvYnJhcl9jb250cmF0byIvPgoJCQkJPC9vNT4KCQkJCTxvNj4KCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCTxDaGVja19Db3VudCB2YWx1ZT0iMCIvPgoJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCTxGaWVsZF9Db3VudCB2YWx1ZT0iMTAiLz4KCQkJCQkJPEhhc19PSURzIHZhbHVlPSIwIi8+CgkJCQkJCTxJRCB2YWx1ZT0iNjAxMzkiLz4KCQkJCQkJPEluZGV4X0NvdW50IHZhbHVlPSIwIi8+CgkJCQkJCTxMaW5rX0NvdW50IHZhbHVlPSIwIi8+CgkJCQkJCTxOYW1lIHZhbHVlPSJpbnZlcnNpb25lc19zdWJzaSIvPgoJCQkJCQk8T2JqZWN0X093bmVyIHZhbHVlPSJldXJla2EiLz4KCQkJCQkJPFByaW1hcnlfS2V5IHZhbHVlPSJhV1E9Ii8+CgkJCQkJCTxQcmltYXJ5X0tleV9OYW1lIHZhbHVlPSJpbnZlcnNpb25lc19zdWJzaV9wa2V5Ii8+CgkJCQkJCTxSZWNvcmRfQ291bnQgdmFsdWU9IjAiLz4KCQkJCQkJPFNjaGVtYSB2YWx1ZT0icHVibGljIi8+CgkJCQkJCTxUcmlnZ2VyX0NvdW50IHZhbHVlPSIwIi8+CgkJCQkJCTxVbmlxdWVfQ291bnQgdmFsdWU9IjAiLz4KCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJPGNvbnRyb2wgdmFsdWU9IlRhYmxlNiIvPgoJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQk8ZmllbGQ+CgkJCQkJCTxvMD4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9IiIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPERpbWVuc2lvbnMgdmFsdWU9IjAiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjUiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJhanVzdGVfaW5mbGFjaW9uIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMzgiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjYiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iTnVtZXJpYyIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJhanVzdGVfaW5mbGFjaW9uIi8+CgkJCQkJCTwvbzA+CgkJCQkJCTxvMT4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9IiIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPERpbWVuc2lvbnMgdmFsdWU9IjAiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjciLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJhbm8iLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iRGF0ZSIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJhbm8iLz4KCQkJCQkJPC9vMT4KCQkJCQkJPG8yPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0nInBnX2NhdGFsb2ciLiJkZWZhdWx0IicvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPERpbWVuc2lvbnMgdmFsdWU9IjAiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjIiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9IjI1NSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJjb25kaWNpb25lcyIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJDaGFyYWN0ZXIgVmFyeWluZyIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJjb25kaWNpb25lcyIvPgoJCQkJCQk8L28yPgoJCQkJCQk8bzM+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iQ2xhdmUgZm9yYW5lYSBhIGxhIHRhYmxhIENvbnRyYXRpc3RhIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxEaW1lbnNpb25zIHZhbHVlPSIwIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSI5Ii8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iY29udHJhdGlzdGFfaWQiLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iSW50ZWdlciIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJjb250cmF0aXN0YV9pZCIvPgoJCQkJCQk8L28zPgoJCQkJCQk8bzQ+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxEaW1lbnNpb25zIHZhbHVlPSIwIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSI0Ii8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iY29zdG9fYWRxdWlzaWNpb24iLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSIzOCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iNiIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJOdW1lcmljIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImNvc3RvX2FkcXVpc2ljaW9uIi8+CgkJCQkJCTwvbzQ+CgkJCQkJCTxvNT4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9IiIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSJDbGF2ZSBmb3JhbmVhIGEgbGEgdGFibGEgRW1wcmVzYXMiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPERpbWVuc2lvbnMgdmFsdWU9IjAiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjgiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJlbXByZXNhX2lkIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkludGVnZXIiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iZW1wcmVzYV9pZCIvPgoJCQkJCQk8L281PgoJCQkJCQk8bzY+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iQ2xhdmUgcHJpbWFyaWEiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0ibmV4dHZhbCgnaW52ZXJzaW9uZXNfc3Vic2lfaWRfc2VxJzo6cmVnY2xhc3MpIi8+CgkJCQkJCQkJPERpbWVuc2lvbnMgdmFsdWU9IjAiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjEwIi8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjEiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iaWQiLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iSW50ZWdlciIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjEiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJpZCIvPgoJCQkJCQk8L282PgoJCQkJCQk8bzc+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPScicGdfY2F0YWxvZyIuImRlZmF1bHQiJy8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RGltZW5zaW9ucyB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iMjU1Ii8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9Imluc3RydW1lbnRvIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkNoYXJhY3RlciBWYXJ5aW5nIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9Imluc3RydW1lbnRvIi8+CgkJCQkJCTwvbzc+CgkJCQkJCTxvOD4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9JyJwZ19jYXRhbG9nIi4iZGVmYXVsdCInLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxEaW1lbnNpb25zIHZhbHVlPSIwIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSIzIi8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8TGVuZ3RoIHZhbHVlPSIyNTUiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0icG9yY2VudGFqZV9wYXJ0aWNpcGFjaW9uIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkNoYXJhY3RlciBWYXJ5aW5nIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9InBvcmNlbnRhamVfcGFydGljaXBhY2lvbiIvPgoJCQkJCQk8L284PgoJCQkJCQk8bzk+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iU2FsZG8gc2Vnw7puIGNvbnRhYmlsaWRhZCIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RGltZW5zaW9ucyB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iNiIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9InNhbGRvX2NvbnRhYmlsaWRhZCIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjM4Ii8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSI2Ii8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9Ik51bWVyaWMiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0ic2FsZG9fY29udGFiaWxpZGFkIi8+CgkJCQkJCTwvbzk+CgkJCQkJPC9maWVsZD4KCQkJCQk8aWQgdmFsdWU9IjYwMTM5Ii8+CgkJCQkJPG5hbWUgdmFsdWU9ImludmVyc2lvbmVzX3N1YnNpIi8+CgkJCQk8L282PgoJCQkJPG83PgoJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJPENoZWNrX0NvdW50IHZhbHVlPSIwIi8+CgkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJPEZpZWxkX0NvdW50IHZhbHVlPSIxMSIvPgoJCQkJCQk8SGFzX09JRHMgdmFsdWU9IjAiLz4KCQkJCQkJPElEIHZhbHVlPSI2MDEyOSIvPgoJCQkJCQk8SW5kZXhfQ291bnQgdmFsdWU9IjAiLz4KCQkJCQkJPExpbmtfQ291bnQgdmFsdWU9IjAiLz4KCQkJCQkJPE5hbWUgdmFsdWU9ImludmVyc2lvbmVzX2FjdF9jb3JyIi8+CgkJCQkJCTxPYmplY3RfT3duZXIgdmFsdWU9ImV1cmVrYSIvPgoJCQkJCQk8UHJpbWFyeV9LZXkgdmFsdWU9ImFXUT0iLz4KCQkJCQkJPFByaW1hcnlfS2V5X05hbWUgdmFsdWU9ImludmVyc2lvbmVzX2FjdF9jb3JyX3BrZXkiLz4KCQkJCQkJPFJlY29yZF9Db3VudCB2YWx1ZT0iMCIvPgoJCQkJCQk8U2NoZW1hIHZhbHVlPSJwdWJsaWMiLz4KCQkJCQkJPFRyaWdnZXJfQ291bnQgdmFsdWU9IjAiLz4KCQkJCQkJPFVuaXF1ZV9Db3VudCB2YWx1ZT0iMCIvPgoJCQkJCTwvUHJvcGVydGllcz4KCQkJCQk8Y29udHJvbCB2YWx1ZT0iVGFibGU3Ii8+CgkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCTxmaWVsZD4KCQkJCQkJPG8wPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IkFqdXN0ZSBwb3IgaW5mbGFjacOzbiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RGltZW5zaW9ucyB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iNiIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImFqdXN0ZV9pbmZsYWNpb24iLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSIzOCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iNiIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJOdW1lcmljIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImFqdXN0ZV9pbmZsYWNpb24iLz4KCQkJCQkJPC9vMD4KCQkJCQkJPG8xPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RGltZW5zaW9ucyB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iOCIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImFubyIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJEYXRlIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImFubyIvPgoJCQkJCQk8L28xPgoJCQkJCQk8bzEwPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0nInBnX2NhdGFsb2ciLiJkZWZhdWx0IicvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSJDbGFzaWZpY2FkYXMgY29tbyBhY3Rpdm8gY29ycmllbnRlCkNsYXNpZmljYWRhcyBjb21vIGFjdGl2byBubyBjb3JyaWVudGUgRGlzcG9uaWJsZXMgcGFyYSBsYSB2ZW50YSB5IG1hbnRlbmlkYXMgaGFzdGEgZWwgdmVuY2ltaWVudG8iLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPERpbWVuc2lvbnMgdmFsdWU9IjAiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjEwIi8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8TGVuZ3RoIHZhbHVlPSIyNTUiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0idGlwbyIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJDaGFyYWN0ZXIgVmFyeWluZyIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJ0aXBvIi8+CgkJCQkJCTwvbzEwPgoJCQkJCQk8bzI+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPScicGdfY2F0YWxvZyIuImRlZmF1bHQiJy8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RGltZW5zaW9ucyB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iNCIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iMjU1Ii8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImNvbmRpY2lvbmVzIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkNoYXJhY3RlciBWYXJ5aW5nIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImNvbmRpY2lvbmVzIi8+CgkJCQkJCTwvbzI+CgkJCQkJCTxvMz4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9IiIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPERpbWVuc2lvbnMgdmFsdWU9IjAiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjIiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJjb250cmF0aXN0YV9pZCIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJJbnRlZ2VyIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImNvbnRyYXRpc3RhX2lkIi8+CgkJCQkJCTwvbzM+CgkJCQkJCTxvND4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9IiIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPERpbWVuc2lvbnMgdmFsdWU9IjAiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjUiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJjb3N0b19hZHF1aXNpY2lvbiIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjM4Ii8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSI2Ii8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9Ik51bWVyaWMiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iY29zdG9fYWRxdWlzaWNpb24iLz4KCQkJCQkJPC9vND4KCQkJCQkJPG81PgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IkNsYXZlIGZvcmFuZWEgYSBsYSB0YWJsYSBFbXByZXNhcyIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RGltZW5zaW9ucyB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMTEiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJlbXByZXNhX2lkIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkludGVnZXIiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iZW1wcmVzYV9pZCIvPgoJCQkJCQk8L281PgoJCQkJCQk8bzY+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9Im5leHR2YWwoJ2ludmVyc2lvbmVzMV9pZF9zZXEnOjpyZWdjbGFzcykiLz4KCQkJCQkJCQk8RGltZW5zaW9ucyB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIxIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImlkIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkludGVnZXIiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIxIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iaWQiLz4KCQkJCQkJPC9vNj4KCQkJCQkJPG83PgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0nInBnX2NhdGFsb2ciLiJkZWZhdWx0IicvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPERpbWVuc2lvbnMgdmFsdWU9IjAiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjMiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9IjI1NSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJpbnN0cnVtZW50byIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJDaGFyYWN0ZXIgVmFyeWluZyIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJpbnN0cnVtZW50byIvPgoJCQkJCQk8L283PgoJCQkJCQk8bzg+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iUMOpcmRpZGEgcG9yIGRldGVyaW9ybyBkZWwgdmFsb3IiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPERpbWVuc2lvbnMgdmFsdWU9IjAiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjkiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJwZXJkaWRhX3ZhbG9yIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMzgiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjYiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iTnVtZXJpYyIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJwZXJkaWRhX3ZhbG9yIi8+CgkJCQkJCTwvbzg+CgkJCQkJCTxvOT4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9IiIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSJTYWxkbyBzZWfDum4gY29udGFiaWxpZGFkIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxEaW1lbnNpb25zIHZhbHVlPSIwIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSI3Ii8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0ic2FsZG9fY29udGFiaWxpZGFkIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMzgiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjYiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iTnVtZXJpYyIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJzYWxkb19jb250YWJpbGlkYWQiLz4KCQkJCQkJPC9vOT4KCQkJCQk8L2ZpZWxkPgoJCQkJCTxpZCB2YWx1ZT0iNjAxMjkiLz4KCQkJCQk8bmFtZSB2YWx1ZT0iaW52ZXJzaW9uZXNfYWN0X2NvcnIiLz4KCQkJCTwvbzc+CgkJCTwvdGFibGU+CgkJPC9wdWJsaWM+Cgk8L01vZGVsPgo8L3Byb3BlcnRpZXM+Cgo=	\N	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	\N	\N	2
\.


--
-- Name: Bancos_pkey; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY bancos
    ADD CONSTRAINT "Bancos_pkey" PRIMARY KEY (id);


--
-- Name: accionistas_id_key; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY accionistas
    ADD CONSTRAINT accionistas_id_key UNIQUE (id);


--
-- Name: accionistas_pkey; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY accionistas
    ADD CONSTRAINT accionistas_pkey PRIMARY KEY (persona_natural_id, contratista_id);


--
-- Name: bancos_contratistas_pkey; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY bancos_contratistas
    ADD CONSTRAINT bancos_contratistas_pkey PRIMARY KEY (id);


--
-- Name: clientes_pk; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY clientes
    ADD CONSTRAINT clientes_pk PRIMARY KEY (id);


--
-- Name: contratistas_pkey; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY contratistas
    ADD CONSTRAINT contratistas_pkey PRIMARY KEY (id);


--
-- Name: cuentas_cobrar_spri_pkey; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY cuentas_cobrar_sprivpub
    ADD CONSTRAINT cuentas_cobrar_spri_pkey PRIMARY KEY (id);


--
-- Name: cuentas_nombre_key; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY cuentas
    ADD CONSTRAINT cuentas_nombre_key UNIQUE (nombre);


--
-- Name: cuentas_pkey; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY cuentas
    ADD CONSTRAINT cuentas_pkey PRIMARY KEY (id);


--
-- Name: deudores_pk; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY otras_cuentas_cobrar
    ADD CONSTRAINT deudores_pk PRIMARY KEY (id);


--
-- Name: directores_id_key; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY directores
    ADD CONSTRAINT directores_id_key UNIQUE (id);


--
-- Name: directores_pkey; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY directores
    ADD CONSTRAINT directores_pkey PRIMARY KEY (persona_natural_id, contratista_id);


--
-- Name: efectivo_banco_pkey; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY efectivo_banco
    ADD CONSTRAINT efectivo_banco_pkey PRIMARY KEY (id);


--
-- Name: efectivo_caja_pkey; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY efectivo_caja
    ADD CONSTRAINT efectivo_caja_pkey PRIMARY KEY (id);


--
-- Name: empresas_pkey; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY personas_juridicas
    ADD CONSTRAINT empresas_pkey PRIMARY KEY (id);


--
-- Name: empresas_relacionadas_id_key; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY empresas_relacionadas
    ADD CONSTRAINT empresas_relacionadas_id_key UNIQUE (id);


--
-- Name: empresas_relacionadas_pkey; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY empresas_relacionadas
    ADD CONSTRAINT empresas_relacionadas_pkey PRIMARY KEY (empresa_id, contratista_id);


--
-- Name: gastos_pag_ant_pkey; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY gastos_pag_ant
    ADD CONSTRAINT gastos_pag_ant_pkey PRIMARY KEY (id);


--
-- Name: inpc_pkey; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY inpc
    ADD CONSTRAINT inpc_pkey PRIMARY KEY (id);


--
-- Name: inventario_pkey; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY inventarios
    ADD CONSTRAINT inventario_pkey PRIMARY KEY (id);


--
-- Name: inventarios_c_pkey; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY inventarios_c
    ADD CONSTRAINT inventarios_c_pkey PRIMARY KEY (id);


--
-- Name: inversiones_pkey; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY inversiones
    ADD CONSTRAINT inversiones_pkey PRIMARY KEY (id);


--
-- Name: migration_pkey; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY migration
    ADD CONSTRAINT migration_pkey PRIMARY KEY (version);


--
-- Name: notas_revelatorias_pkey; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY notas_revelatorias
    ADD CONSTRAINT notas_revelatorias_pkey PRIMARY KEY (id);


--
-- Name: personas_juridicas_rif_key; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY personas_juridicas
    ADD CONSTRAINT personas_juridicas_rif_key UNIQUE (rif);


--
-- Name: personas_naturales_pkey; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY personas_naturales
    ADD CONSTRAINT personas_naturales_pkey PRIMARY KEY (id);


--
-- Name: reps_legales_pkey; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY reps_legales
    ADD CONSTRAINT reps_legales_pkey PRIMARY KEY (id);


--
-- Name: sustento_conts_pkey; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY sustento_conts
    ADD CONSTRAINT sustento_conts_pkey PRIMARY KEY (id);


--
-- Name: tipo_caja_pkey; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY tipos_cajas
    ADD CONSTRAINT tipo_caja_pkey PRIMARY KEY (id);


--
-- Name: tipos_cajas_nombre_key; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY tipos_cajas
    ADD CONSTRAINT tipos_cajas_nombre_key UNIQUE (nombre);


--
-- Name: tipos_deudores_nombre_key; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY tipos_deudores
    ADD CONSTRAINT tipos_deudores_nombre_key UNIQUE (nombre);


--
-- Name: tipos_deudores_pkey; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY tipos_deudores
    ADD CONSTRAINT tipos_deudores_pkey PRIMARY KEY (id);


--
-- Name: tipos_inversiones_pkey; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY tipos_inversiones
    ADD CONSTRAINT tipos_inversiones_pkey PRIMARY KEY (id);


--
-- Name: tipos_sustentos_pkey; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY tipos_sustentos
    ADD CONSTRAINT tipos_sustentos_pkey PRIMARY KEY (id);


--
-- Name: user_pkey; Type: CONSTRAINT; Schema: public; Owner: eureka; Tablespace: 
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- Name: variables_globales_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY variables_globales
    ADD CONSTRAINT variables_globales_pkey PRIMARY KEY (id);


--
-- Name: fki_contratista_id; Type: INDEX; Schema: public; Owner: eureka; Tablespace: 
--

CREATE INDEX fki_contratista_id ON clientes USING btree (contratista_id);


--
-- Name: fki_contratista_sustento; Type: INDEX; Schema: public; Owner: eureka; Tablespace: 
--

CREATE INDEX fki_contratista_sustento ON sustento_conts USING btree (contratista_id);


--
-- Name: fki_cuentas_contratista; Type: INDEX; Schema: public; Owner: eureka; Tablespace: 
--

CREATE INDEX fki_cuentas_contratista ON cuentas_cobrar_sprivpub USING btree (contatista_id);


--
-- Name: fki_inventarios_c_contratista; Type: INDEX; Schema: public; Owner: eureka; Tablespace: 
--

CREATE INDEX fki_inventarios_c_contratista ON inventarios_c USING btree (contratista_id);


--
-- Name: fki_inversiones_tipo; Type: INDEX; Schema: public; Owner: eureka; Tablespace: 
--

CREATE INDEX fki_inversiones_tipo ON inversiones USING btree (tipo_inversion);


--
-- Name: fki_tipo_sustento_id; Type: INDEX; Schema: public; Owner: eureka; Tablespace: 
--

CREATE INDEX fki_tipo_sustento_id ON sustento_conts USING btree (tipo_sustento_id);


--
-- Name: accionistas_contratista_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY accionistas
    ADD CONSTRAINT accionistas_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id);


--
-- Name: accionistas_persona_natural_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY accionistas
    ADD CONSTRAINT accionistas_persona_natural_id_fkey FOREIGN KEY (persona_natural_id) REFERENCES personas_naturales(id);


--
-- Name: bancos_contratistas_banco_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY bancos_contratistas
    ADD CONSTRAINT bancos_contratistas_banco_id_fkey FOREIGN KEY (banco_id) REFERENCES bancos(id);


--
-- Name: bancos_contratistas_contratista_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY bancos_contratistas
    ADD CONSTRAINT bancos_contratistas_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id);


--
-- Name: contratistas_empresa_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY contratistas
    ADD CONSTRAINT contratistas_empresa_id_fkey FOREIGN KEY (empresa_id) REFERENCES personas_juridicas(id);


--
-- Name: directores_contratista_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY directores
    ADD CONSTRAINT directores_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id);


--
-- Name: directores_persona_natural_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY directores
    ADD CONSTRAINT directores_persona_natural_id_fkey FOREIGN KEY (persona_natural_id) REFERENCES personas_naturales(id);


--
-- Name: efectivo_banco_banco_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY efectivo_banco
    ADD CONSTRAINT efectivo_banco_banco_id_fkey FOREIGN KEY (banco_id) REFERENCES bancos(id);


--
-- Name: efectivo_banco_contratista_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY efectivo_banco
    ADD CONSTRAINT efectivo_banco_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id) ON UPDATE CASCADE;


--
-- Name: efectivo_caja_contratista_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY efectivo_caja
    ADD CONSTRAINT efectivo_caja_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id) ON UPDATE CASCADE;


--
-- Name: efectivo_caja_tipo_caja_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY efectivo_caja
    ADD CONSTRAINT efectivo_caja_tipo_caja_id_fkey FOREIGN KEY (tipo_caja_id) REFERENCES tipos_cajas(id);


--
-- Name: empresas_relacionadas_contratista_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY empresas_relacionadas
    ADD CONSTRAINT empresas_relacionadas_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id);


--
-- Name: empresas_relacionadas_empresa_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY empresas_relacionadas
    ADD CONSTRAINT empresas_relacionadas_empresa_id_fkey FOREIGN KEY (empresa_id) REFERENCES personas_juridicas(id);


--
-- Name: fk_contratista_id; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY clientes
    ADD CONSTRAINT fk_contratista_id FOREIGN KEY (contratista_id) REFERENCES contratistas(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: fk_contratista_sustento; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY sustento_conts
    ADD CONSTRAINT fk_contratista_sustento FOREIGN KEY (contratista_id) REFERENCES contratistas(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: fk_cuentas_contratista; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY cuentas_cobrar_sprivpub
    ADD CONSTRAINT fk_cuentas_contratista FOREIGN KEY (contatista_id) REFERENCES contratistas(id);


--
-- Name: fk_inventarios_c_contratista; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY inventarios_c
    ADD CONSTRAINT fk_inventarios_c_contratista FOREIGN KEY (contratista_id) REFERENCES contratistas(id);


--
-- Name: fk_inversiones_tipo; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY inversiones
    ADD CONSTRAINT fk_inversiones_tipo FOREIGN KEY (tipo_inversion) REFERENCES tipos_inversiones(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: fk_tipo_sustento_id; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY sustento_conts
    ADD CONSTRAINT fk_tipo_sustento_id FOREIGN KEY (tipo_sustento_id) REFERENCES tipos_sustentos(id);


--
-- Name: inversiones_banco_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY inversiones
    ADD CONSTRAINT inversiones_banco_id_fkey FOREIGN KEY (banco_id) REFERENCES bancos(id);


--
-- Name: inversiones_contratista_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY inversiones
    ADD CONSTRAINT inversiones_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id);


--
-- Name: notas_revelatorias_contratista_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY notas_revelatorias
    ADD CONSTRAINT notas_revelatorias_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id);


--
-- Name: notas_revelatorias_usuario_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY notas_revelatorias
    ADD CONSTRAINT notas_revelatorias_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES "user"(id);


--
-- Name: otras_cuentas_cobrar_contratista_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY otras_cuentas_cobrar
    ADD CONSTRAINT otras_cuentas_cobrar_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id);


--
-- Name: otras_cuentas_cobrar_tipo_deudor_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY otras_cuentas_cobrar
    ADD CONSTRAINT otras_cuentas_cobrar_tipo_deudor_id_fkey FOREIGN KEY (tipo_deudor_id) REFERENCES tipos_deudores(id);


--
-- Name: reps_legales_contratista_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY reps_legales
    ADD CONSTRAINT reps_legales_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id);


--
-- Name: reps_legales_persona_natural_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY reps_legales
    ADD CONSTRAINT reps_legales_persona_natural_id_fkey FOREIGN KEY (persona_natural_id) REFERENCES personas_naturales(id);


--
-- Name: tipos_caja_contratista_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: eureka
--

ALTER TABLE ONLY tipos_cajas
    ADD CONSTRAINT tipos_caja_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id);


--
-- Name: variables_globales_contratista_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY variables_globales
    ADD CONSTRAINT variables_globales_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--
