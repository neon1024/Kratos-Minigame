CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

CREATE TABLE Games
(
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4()
);
