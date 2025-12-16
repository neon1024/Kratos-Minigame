CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

CREATE TABLE IF NOT EXISTS Skills
(
    id   UUID PRIMARY KEY DEFAULT uuid_generate_v4(),

    name VARCHAR(32)
);
