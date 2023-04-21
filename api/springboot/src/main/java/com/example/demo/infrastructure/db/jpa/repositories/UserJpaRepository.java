package com.example.demo.infrastructure.db.jpa.repositories;


import org.springframework.data.jpa.repository.JpaRepository;

import com.example.demo.infrastructure.db.jpa.entities.UserJpaEntity;

public interface UserJpaRepository extends JpaRepository<UserJpaEntity, Long> {
}
