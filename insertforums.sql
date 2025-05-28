DELETE FROM forum WHERE name LIKE 'Comments for%';


INSERT INTO forum (name, date_created) VALUES
('Comments for Single: wave', NOW()),
('Comments for Single: light', NOW()),
('Comments for Single: surf.', NOW()),
('Comments for Single: pueblo', NOW()),
('Comments for Single: daisy.', NOW()),
('Comments for Single: nouvelle vague', NOW()),
('Comments for Single: calla', NOW()),
('Comments for Single: dried flower', NOW());

INSERT INTO forum (name, date_created) VALUES
('Comments for EP: wave 0.01', NOW()),
('Comments for EP: summer flows 0.02', NOW());


INSERT INTO forum (name, date_created) VALUES
('Comments for Album: 0.1 flaws and all.', NOW()),
('Comments for Album: play with earth! 0.03', NOW());