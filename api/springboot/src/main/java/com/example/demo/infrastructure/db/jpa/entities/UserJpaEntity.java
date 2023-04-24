package com.example.demo.infrastructure.db.jpa.entities;

import com.example.demo.domain.model.User;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.Table;
import lombok.Getter;
import lombok.Setter;

@Getter
@Setter
@Entity
@Table(name = "users")
public class UserJpaEntity {

  @Id
  @GeneratedValue(strategy = GenerationType.IDENTITY)
  private Long id;

  private String name;

  private String email;

  public UserJpaEntity(String name, String email) {
    this.name = name;
    this.email = email;
  }

  public User toUser() {
    return new User(name, email);
  }
}
