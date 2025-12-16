CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

CREATE TABLE IF NOT EXISTS Turns
(
    turn_id              UUID DEFAULT uuid_generate_v4(),
    game_id              UUID NOT NULL,

    FOREIGN KEY (game_id) REFERENCES Games (id),
    PRIMARY KEY (game_id, turn_id),

    turn_number          INT,
    defender_health_left NUMERIC(3, 2),
    damage_done          NUMERIC(3, 2)
);
