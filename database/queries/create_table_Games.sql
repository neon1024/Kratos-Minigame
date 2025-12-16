CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

CREATE TABLE IF NOT EXISTS Games
(
    id        UUID PRIMARY KEY DEFAULT uuid_generate_v4(),

    winner_id UUID,
    FOREIGN KEY (winner_id) REFERENCES Entities (id) ON DELETE SET NULL
);
