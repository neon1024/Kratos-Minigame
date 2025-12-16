CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

CREATE TABLE IF NOT EXISTS Entities
(
    id   UUID PRIMARY KEY DEFAULT uuid_generate_v4(),

    name VARCHAR(32)
);
