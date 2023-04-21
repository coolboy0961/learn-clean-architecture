package com.example.demo.application.usecases;

import com.example.demo.application.UserRepository;
import com.example.demo.domain.model.User;
import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.extension.ExtendWith;
import org.mockito.InjectMocks;
import org.mockito.Mock;
import org.mockito.junit.jupiter.MockitoExtension;

import static org.junit.jupiter.api.Assertions.assertEquals;
import static org.mockito.Mockito.times;
import static org.mockito.Mockito.verify;
import static org.mockito.Mockito.when;

@ExtendWith(MockitoExtension.class)
class UserUseCaseTest {

  @InjectMocks
  private UserUseCase userUseCase;

  @Mock
  private UserRepository userRepository;

  @Test
    void createUser() {
        // Arrange
        User expectedUser = new User("John Doe", "john@example.com");
        when(userRepository.save(expectedUser))
          .thenReturn(expectedUser);

        // Act
        User actualUser = userUseCase.createUser(expectedUser);

        // Assert
        assertEquals(expectedUser, actualUser);
        verify(userRepository, times(1)).save(expectedUser);
    }
}
