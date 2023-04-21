package com.example.demo.adapters.controllers;

import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.extension.ExtendWith;
import org.mockito.InjectMocks;
import org.mockito.Mock;
import org.mockito.junit.jupiter.MockitoExtension;
import org.springframework.http.MediaType;
import org.springframework.test.web.servlet.MockMvc;
import org.springframework.test.web.servlet.MvcResult;
import org.springframework.test.web.servlet.setup.MockMvcBuilders;

import com.example.demo.application.usecases.UserUseCase;
import com.example.demo.domain.model.User;
import static org.junit.jupiter.api.Assertions.assertEquals;
import static org.mockito.ArgumentMatchers.any;
import static org.mockito.ArgumentMatchers.argThat;
import static org.mockito.Mockito.times;
import static org.mockito.Mockito.verify;
import static org.mockito.Mockito.when;
import static org.springframework.test.web.servlet.request.MockMvcRequestBuilders.post;

@ExtendWith(MockitoExtension.class)
class UserControllerTest {

  @InjectMocks
  private UserController userController;

  @Mock
  private UserUseCase userUseCase;

  @Test
  void createUser() throws Exception {
    // Arrange
    int expectedStatus = 201;
    String expectedResponseJson = """
        {
          "name": "John Doe",
          "email": "john@example.com"
        }
        """;

    when(userUseCase
        .createUser(any(User.class)))
        .thenReturn(new User("John Doe", "john@example.com"));

    // Act
    MockMvc mockMvc = MockMvcBuilders.standaloneSetup(userController).build();
    MvcResult mvcResult = mockMvc.perform(post("/api/v1/users")
        .contentType(MediaType.APPLICATION_JSON)
        .content("""
            {
              "name": "John Doe",
              "email": "john@example.com"
            }
            """))
        .andReturn();

    int actualStatus = mvcResult.getResponse().getStatus();
    String actualResponseJson = mvcResult.getResponse().getContentAsString();

    // Assert
    verify(userUseCase, times(1))
        .createUser(argThat(user -> user.getName().equals("John Doe") && user.getEmail().equals("john@example.com")));
    assertEquals(expectedStatus, actualStatus);
    assertEquals(
        expectedResponseJson.replaceAll("\\s", ""),
        actualResponseJson.replaceAll("\\s", ""));
  }
}
